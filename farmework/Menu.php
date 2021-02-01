<?php
class Menu {
    public static function GetMenu($m,$p,$idUser){
            $sqlExec = "select m.module, m.name, p.menuname, p.keyname, p.icon, m.icon as mod_icon from sys_pages p 
                        inner join sys_rel_pages_modules pm on p.id = pm.id_page 
                        inner join sys_rel_users_pages up on up.id_page = p.id and up.permission = 1
                        inner join sys_modules m on m.id = pm.id_module 
                        where up.id_user = ".$idUser."
                        order by m.order, p.order ASC";
        $resultMenu = DataBase::ExecuteQuery($sqlExec,'Select');

        $arrayMenu = [];
        foreach($resultMenu as $value){
            $arrayPage = [];
            $arrayPage['menuname'] = $value['menuname'];
            $arrayPage['keyname'] = $value['keyname'];
            $arrayPage['namemodule'] = $value['name'];
            $arrayPage['icon'] = $value['icon'];
            $arrayPage['mod_icon'] = $value['mod_icon'];
           
            $arrayMenu[$value['module']][] =  $arrayPage;
        }

        $htmlMenu = '';
        foreach ($arrayMenu as $key => $arrayPage){ 
            $htmlMenusub = '';
            foreach ($arrayPage as $value){ 
                $htmlMenusub  .= '<li style="margin-left: 15px;" class="nav-item">
                                    <a href="index.php?p='.$value['keyname'].'&m='.$key.'" class="nav-link '.($p == $value['keyname'] ? 'active': '').'">
                                   '. $value['icon'] .'
                                    <p>'.$value['menuname'].'</p>
                                    </a>
                                </li>';
            }
            
            $htmlMenu  .= ' <li class="nav-item has-treeview '.($m == $key ? 'menu-open': '').' ">
                            <a href="#" class="nav-link '.($m == $key ? 'active': '').'">
                            '. $value['mod_icon'] .'
                                <p>
                                '.$arrayPage[0]['namemodule'].'
                                <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">';
           $htmlMenu  .=  $htmlMenusub;

            $htmlMenu  .= '   </ul>
                         </li>';

        }

        return  $htmlMenu;
    }
}
?>