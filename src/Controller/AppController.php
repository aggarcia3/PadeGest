<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);

        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Usuario',
                'action' => 'login',
            ],
            'authError' => __('No tienes los permisos necesarios para acceder a ese recurso.'),
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'username', 'password' => 'password'],
                    // TODO: antes de que la aplicación se use en producción, hay que reemplazar esto por
                    // un algoritmo de resumen más seguro, como Cake\Auth\DefaultPasswordHasher.
                    // Por ahora, se usa un algoritmo intencionadamente débil para acelerar la generación
                    // de datos de prueba y demostraciones
                    'passwordHasher' => ['className' => 'Weak', 'hashType' => 'md5'],
                    'userModel' => 'Usuario',
                ],
            ],
            'authorize' => ['Controller'],
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'index',
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'index',
            ],
            'storage' => 'Session',
        ]);

        if (Configure::read('skipAuth')) {
            $this->Auth->allow();
        }

        // Hacer AuthComponent accesible a las vistas
        $this->set('Auth', $this->Auth);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
}
