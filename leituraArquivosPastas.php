<?php
$map = directory_map('E:/Arquivos/',2);
        foreach ($map as $key => $value){
            echo "- $key" . "<br />";
            if(gettype($value)==='array'){
                foreach ($value as $val) {
                    echo "&emsp;" . $val . "<br />";
                }
            }
                
        }
