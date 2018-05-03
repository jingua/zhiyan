<?php
	/**
	 *遍历删除目录和文件类
	 */

	class Deldir{
		//删除目录及其目录下的子文件
		Public function delDirAndFile($dirName){
			if($handle = opendir("$dirName")){  
   				while(false !== ($item = readdir($handle))){  
   					if($item != "." && $item != ".."){  
   						if(is_dir("$dirName/$item")){  
   							$this->delDirAndFile("$dirName/$item");  
   						}else{  
   							unlink("$dirName/$item");  
   						}  
   					}  
   				}  
   			closedir($handle);  
   			rmdir($dirName);
            return true;
			}
		}
	}