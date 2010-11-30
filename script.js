   
                        
  if(toolbar){
     var url = encodeURI('lib/plugins/vkeyboard/exe/vkboard.php');      
     toolbar[toolbar.length] = {"type":"mediapopup", "title":"virtual keyboard", "key":"",
                               "icon": "../../plugins/vkeyboard/images/keyboard.gif",
                              "url":   url,
                              'name': 'vkeyboard',
                              'options': 'width=800,height=500,left=20,top=20,scrollbars=no,resizable=yes'                             
                              };
  }
