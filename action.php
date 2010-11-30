<?php
/**
 * Example Action Plugin:   Example Component.
 *
 * @author     Samuele Tognini <samuele@cli.di.unipi.it>
 */

if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once DOKU_PLUGIN.'action.php';
                
class action_plugin_vkeyboard extends DokuWiki_Action_Plugin {

    /**
     * Register its handlers with the DokuWiki's event controller
     */
    function register(&$controller) {

        $controller->register_hook('DOKUWIKI_STARTED', 'BEFORE', $this, 'setVKIcookie');

        if(!isset($_COOKIE['VKB'])) return;        

        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this,
                                   '_hookjs');
        $controller->register_hook('TPL_ACT_RENDER', 'AFTER', $this,
                                   'vki_start');


    }

    /**
     * Hook js script into page headers.
     *
     * @author Samuele Tognini <samuele@cli.di.unipi.it>
     */
    function _hookjs(&$event, $param) {
        
        echo '<script type="text/javascript">var VKI_KBLAYOUT= "' . $_COOKIE['VKB'] . '"; </script>';
        $event->data['script'][] = array(
                            'type'    => 'text/javascript',
                            'charset' => 'utf-8',
                            '_data'   => '',
                            'src'     => DOKU_BASE . 'lib/plugins/vkeyboard/vkeyboard.js');
    }
   
   function vki_start(&$event, $param) {
    echo '<script type="text/javascript">
    if(document.getElementById("wiki__text")) {
       var myInput = document.getElementById("wiki__text");
       if (!myInput.VKI_attached) {
        VKI_attach(myInput);
      }
    }
    </script>';

   }
  function setVKIcookie(&$event, $param) {
       $ini_vki = false;
       if(isset($_REQUEST['vkb']) && $_REQUEST['vkb']) {
          $expire = null;
          setcookie ('VKB',$_REQUEST['vkb'], $expire, '/');     
       }
    
  }
}

