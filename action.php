<?php
/**
 * Action module for vkeyboard plugin
 *
 * @author Myron Turner <turnermm02@shaw.ca>
 */

if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once DOKU_PLUGIN.'action.php';
                
class action_plugin_vkeyboard extends DokuWiki_Action_Plugin {
var $languages;
    /**
     * Register its handlers with the DokuWiki's event controller
     */
    function register(&$controller) {

        $controller->register_hook('DOKUWIKI_STARTED', 'BEFORE', $this, 'setVKIcookie');

        if(!isset($_COOKIE['VKB'])) return;        

        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this,
                                   '_hookjs');
        $controller->register_hook('TPL_ACT_RENDER', 'BEFORE', $this,
                                   'getvkjs');

        $controller->register_hook('TPL_ACT_RENDER', 'AFTER', $this,
                                   'vki_start');

    }

    /**
     * Hook js script into page headers.
     *
     * @author Myron Turner <turnermm02@shaw.ca>
     */
    function _hookjs(&$event, $param) {
        global $conf;
        $lang = $conf['lang'];
        $languages = explode(';;', $_COOKIE['VKB']);
        echo '<script type="text/javascript">' . "\n  //<![CDATA[ \n" .
             'var VKI_KBLAYOUT= "' . $languages[0] . '";' . "\n" .              
             "var VKI_locale='$lang';\n//]]>\n</script>\n";
        $this->languages = $languages;
   
 
    }

  function getvkjs(&$event, $param) {


       $vkjs_top = DOKU_PLUGIN . 'vkeyboard/kb_top.txt';          
       $vkjs_bot = DOKU_PLUGIN . 'vkeyboard/kb_bottom.txt';          
       echo '<script type="text/javascript"> //<![CDATA[' . "\n";        
       echo file_get_contents($vkjs_top);
       foreach($this->languages as $kb_file) {
           echo "\n" . '/*' . $this->VK_filename($kb_file) . '*/' . "\n";
            echo file_get_contents($this->VK_filename($kb_file));
        }
        echo file_get_contents($vkjs_bot);
        echo "\n//]]>\n</script>\n";

  }

   function vki_start(&$event, $param) {

    echo '<script type="text/javascript">        
    if(document.getElementById("wiki__text")) {
       var myInput = document.getElementById("wiki__text");
       if (!myInput.VKI_attached) {
        VKI_attach(myInput,VKI_layout);
      }
    }
    </script>';

   }
  function setVKIcookie(&$event, $param) {
       
       if(isset($_REQUEST['vkb']) && $_REQUEST['vkb']) {
          if($matches = preg_match('/(off)-(.*)/',($_REQUEST['vkb']))) { 
            $expire = time()-(60*60*24);
            setcookie ('VKB',$matches[1], $expire, DOKU_BASE);     
          }
          else {
            $expire = null;          
            setcookie ('VKB',$_REQUEST['vkb'], $expire, DOKU_BASE);     
         }
     }
  }
 
 function VK_filename($name) {
   $fname = trim(trim($name),'"'); 
   $search = array(' ','(',')','/');
   return DOKU_PLUGIN . 'vkeyboard/layouts/' . str_replace($search,'_',$fname) . '.js';
 }

}

