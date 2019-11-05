#!/bin/sh

#############
# Constants #
#############
readonly DB_SCRIPT_FILENAME='BD PadeGest.sql'

echo '- ------------------------- -'
echo '- SQL Worbench script fixer -'
echo '- ------------------------- -'

# Parse command line options
while getopts q option; do
    case $option in
        'q')
            quiet=1;;
        *)
            echo "Syntax: $0 [-q]" >&2
            exit 10;;
    esac
done

# Check that current directory looks OK
if [ ! -f "$DB_SCRIPT_FILENAME" ] || [ ! -r "$DB_SCRIPT_FILENAME" ]; then
    echo "! Database generation script $DB_SCRIPT_FILENAME not found. Are you in the appropriate working directory?" >&2
    exit 1
fi

# Check if the modifications look applied
if [ "$(head -n 1 "$DB_SCRIPT_FILENAME")" = '-- -----------------------------------------------------' ] && [ -z "$quiet" ]; then
    printf "It seems that this script was already applied to %s. Continue anyway? (Y/N) " "$DB_SCRIPT_FILENAME"

    ttyConfig=$(stty -g)
    stty -icanon min 1 time 0
    answer=$(dd bs=1 count=1 2>/dev/null)
    stty "$ttyConfig"

    if ! { [ "$answer" = 'y' ] || [ "$answer" = 'Y' ]; }; then
        exit
    fi
fi

# Get temporary file name
TMPDIR="${TMPDIR:=/tmp}"
scriptName=$(basename "$0")
tmpFile="$TMPDIR/$scriptName.tmp"

# Apply patches to the script generated by SQL Workbench
printf '\n> Applying patches...\n'
for patchFile in *.patch; do
    if [ -f "$patchFile" ] && [ -r "$patchFile" ]; then
        {
            echo "  Applying patch $patchFile..."
            patch -s "$DB_SCRIPT_FILENAME" "$patchFile"
        } || { echo "! Patch $patchFile unsuccessful, aborting script execution." >&2; exit 3; }
    fi
done

# Append extra SQL scripts
printf '\n> Appending extra SQL scripts...\n'
for extraSql in sql-scripts/*.sql; do
    if [ -f "$extraSql" ] && [ -r "$extraSql" ]; then
        originalScript=$(cat "$DB_SCRIPT_FILENAME" || { echo "! Can't read extra SQL script $extraSql, aborting script execution." >&2; exit 4; })
        {
            echo "  Appending $extraSql script..."
            printf "%s\n\n" "$originalScript" | cat - "$extraSql" > "$tmpFile"
            mv "$tmpFile" "$DB_SCRIPT_FILENAME"
        } || { echo "! Can't append extra SQL script $extraSql, aborting script execution." >&2; exit 5; }
    fi
done

# Remove first 6 lines, which contain unwanted metadata and comments
printf '\n> Removing initial comments...\n'
{
    tail -n +6 "$DB_SCRIPT_FILENAME" > "$tmpFile"
    mv "$tmpFile" "$DB_SCRIPT_FILENAME"
} || { echo '! Header removal unsuccessful, aborting script execution.' >&2; exit 2; }

printf '\n> Adding custom initial comments...\n'
{
    printf -- '-- -----------------------------------------------------\n-- PadeGest application database\n-- For use by PadeGest\n-- Generated on %s\n-- -----------------------------------------------------\n' "$(LANG=en_US date '+%m %b %Y %T %Z')" | cat - "$DB_SCRIPT_FILENAME" > "$tmpFile"
    mv "$tmpFile" "$DB_SCRIPT_FILENAME"
} || { echo '! Header insertion unsuccessful, aborting script execution.' >&2; exit 3; }

printf '\nDone.\n'
