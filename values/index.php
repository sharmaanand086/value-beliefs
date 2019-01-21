 <?php 
 function isMobile()
 {
 return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);

}
                        #desktop
                        if(!isMobile()){
                                
                                      ?>
                                    <script type="text/javascript">
                                       window.location = 'login.php';
                                    </script>
                                <?php
                                  }
                                 ?>
                      
                        
                        <?php
                         #moblie
                        if(isMobile()){
                            
                                      ?>
                                    <script type="text/javascript">
                                       window.location = 'http://www.arfeenkhan.com/incredibleyou/values/mobile/';
                                    </script>
                                <?php
                                  }
                                 ?>
                       
