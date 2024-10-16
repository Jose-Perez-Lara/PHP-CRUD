<?php
    file_put_contents('../csv/equipos.csv',"Tigres FC,18,25,1\nÁguilas Doradas,12,25,2\nLeones Rojos,15,25,3\nPumas Negros,20,25,4\nHalcones Azules,10,25,5\n",FILE_APPEND);
    header('Location: ..');
?>