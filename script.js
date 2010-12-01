   /** 
    * Add toolbar item for vkeyboard plugin
    * @author Myron Turner <turnermm02@shaw.ca>
  */
                        
  if(toolbar){
     var url = encodeURI('lib/plugins/vkeyboard/exe/vkboard.php');      
     toolbar[toolbar.length] = {"type":"mediapopup", "title":"virtual keyboard", "key":"",
                               "icon": "../../plugins/vkeyboard/images/keyboard.gif",
                              "url":   url,
                              'name': 'vkeyboard',
                              'options': 'width=600,height=500,left=25,top=25,scrollbars=no,resizable=yes'                             
                              };
  }
