<?php
namespace backend\components;
use Yii;
use yii\helpers\Url;
use backend\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Menuadmin;
use common\models\Roles;
use common\models\Rolespermisodef;
use common\models\Rolespermisos;
use common\models\Rolesusuario;
use backend\components\Log_errores;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/12/21
 * Time: 11:47
 */

class Menu_admin extends Component
{

    public function getMenu($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getMenuadmin($rol=0,$context='')
    {
        if ($all){

        }else{

        }
        //$menu=['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest];
        $menuModel= Menuadmin::find()->where(["tipo"=>"WEB","idparent"=>"0","estatus"=>"ACTIVO","isDeleted"=>0])->orderBy(["orden"=>SORT_ASC])->all();
        $rolusuario=Rolesusuario::find()->where(["idusuario"=>Yii::$app->user->identity->id,"estatus"=>"ACTIVO","isDeleted"=>0])->one();
        if ($rolusuario){
            $rol=$rolusuario["idrol"];
            $nombrerol= $rolusuario->idrol0->nombre;
            $permisos=Rolespermisos::find()->where(["idrol"=>$rol,"estatus"=>"ACTIVO","isDeleted"=>0])->all();
            $permisosdef=Rolespermisodef::find()->where(["estatus"=>"ACTIVO","isDeleted"=>0])->all();
            //var_dump($permisosdef);
            $permitidomenu=false;
            foreach ($menuModel as $key => $data) {
                //$permisosdef=Rolespermisodef::find()->where(["idmenu"=>$data->id,"estatus"=>"ACTIVO","isDeleted"=>0])->one();
                //echo $data->id;
                //var_dump($permisosdef);
                $permitidomenu=false;

                $arrayPermisos= array();
                $submodulos= array();
                foreach ($permisos as $key => $valueper) {
                    foreach ($valueper->idmodulo0 as $key => $valueperdet) {
                        //$submodulos[]=$valueperdet;
                        //var_dump($valueper);
                        //echo ($valueperdet["idmenu"].' => '.$data->id.'<br> ');
                        if ($valueperdet["idmenu"]==$data->id){$permitidomenu=true;}
                    }
                    if ($valueper->idsubmodulo){
                        //echo $valueper->idsubmodulo0->id ;
                        foreach ($valueper->idsubmodulo0 as $key => $valuepersubdet) {
                            //echo ($valuepersubdet["nombreint"]. '<br> ');

                            $submodulos[]=$valuepersubdet["nombreint"];
                            //var_dump($valueper);
                            //echo $valueperdet["nombreint"];
                        }
                    }


                }
                foreach ($permisosdef as $key => $valuedef) {
                    //echo ($valuedef["idmenu"].' => '.$data->id.'<br> ');
                    if ($valuedef["idmenu"]==$data->id){$permitidomenu=true;}
                }
                //var_dump($submodulos);

                if ($permitidomenu){
                    $subMenuModel= Menuadmin::find()->where(["tipo"=>"WEB","idparent"=>$data->id,"estatus"=>"ACTIVO","isDeleted"=>0])->orderBy(["orden"=>SORT_ASC])->all();
                    if ($subMenuModel)
                    {
                        $subMenu= array();
                        $contsubmenu=0;
                        foreach ($subMenuModel as $key => $data2) {
                            //if ($data2->nombre=="Mensajes"){ $template='<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-yellow">123</small></span></a>'; }
                            //echo ' || '.$data2->rolpermiso. '<br>' ;
                            //echo ' || '.$data2->nombre. '<br>' ;
                            if ($data2->nombre=="Mensajes" || $data2->nombre=="mensajes" || $data2->nombre=="notificaciones" || $data2->nombre=="Notificaciones"){
                                $contsubmenu++;
                                $template='<a href="{url}" class="nav-link " style="width: 100%;">{icon} '.$data2->nombre.' <span class="pull-right-container"><small class="label bg-cyan rounded" style="padding: 2px 5px 2px 5px;">0</small></span></a>';
                                $subMenu[]=array('label' => $data2->nombre,'options'=> ['data-class'=>'submenu1','style'=>'padding-left:3%;'], 'icon' => $data2->icono, 'url' => [$data2->link],'active' => '/'.$context == $data2->link,'template'=>$template);
                            }else{
                                $permitidosubmenu=false;
                                //echo '||'.$permisonom=$data2->rolpermiso.'||';
                                //var_dump ($submodulos);
                                if ($data2->rolpermiso){
                                    foreach ($submodulos as $valsubmodulo) {
                                        //var_dump($valueper);
                                        //if ($valueperdet["nombreint"]==$valueper->id){}
                                        //echo $valueperdet["nombreint"];
                                        //echo $data2->rolpermiso;
                                        //echo ' || '.$data2->rolpermiso. ' => '.$valsubmodulo.'<br>' ;
                                        if ($data2->rolpermiso==$valsubmodulo){$permitidosubmenu=true; }
                                    }

                                    foreach ($permisosdef as $key => $valuedef) {
                                        //echo ($valuedef["idmenu"].' => '.$data->id.'<br> ');
                                        if ($valuedef["nombreint"]==$data2->rolpermiso){$permitidosubmenu=true;}
                                    }
                                    if ($permitidosubmenu){
                                        $contsubmenu++;
                                        $template='<a href="{url}" class="nav-link " style="width: 100%;">{icon} '.$data2->nombre.' </a>';
                                        $subMenu[]=array('label' => $data2->nombre,'options'=> ['data-class'=>'submenu2','style'=>'padding-left:3%;'], 'icon' => $data2->icono, 'url' => [$data2->link],'active' => '/'.$context == $data2->link,'template'=>$template);
                                    }
                                }
                            }
                        }
                        if ($contsubmenu!=0){
                            $menu[]= array('label' => $data->nombre, 'icon' => $data->icono,'options'=> ['data-class'=>'menu1'], 'items' => $subMenu);
                        }else{
                            $menu[]= array('label' => $data->nombre, 'icon' => $data->icono,'options'=> ['data-class'=>'menu2'], 'url' => [$data->link]);
                        }
                    }else{
                        $menu[]= array('label' => $data->nombre, 'icon' => $data->icono,'options'=> ['data-class'=>'menu2'], 'url' => [$data->link]);
                    }
                }else{
                    //$menu[]= array('label' => $data->nombre, 'icon' => $data->icono,'options'=> ['data-class'=>'menu1'], 'items' => $subMenu);
                }

            }
        }
        return $menu;
    }

    public function getPermiso($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Cuentas::find()->where(["codigoant"=>$id])->one();
            if ($result)
            {
                $result=$result["codigoant"].' ('.$result["nombre"].')';
            }else{
                $result="NINGUNO";
            }
        }else{
            $result= false;
        }
        return $result;
    }

    public function Nuevo($roles)
    {
        //$date = date("Y-m-d H:i:s");
        $idmenu=0;
        $modelMenu= new Menuadmin;
        $result=false;
        if ($roles):
            $modelMenu->nombre=$roles["nombre"];
            $modelMenu->icono=$roles["icono"];
            $modelMenu->link=$roles["link"];
            $modelMenu->orden=$roles["orden"];
            $modelMenu->idparent=$roles["superior"];
            $modelMenu->usuarioc=Yii::$app->user->identity->id;
            $modelMenu->usuariom=Yii::$app->user->identity->id;
            //$modelMenu->fechacreacion=$roles->idfactura;
            $modelMenu->isDeleted=0;
            $modelMenu->estatus="ACTIVO";
            //var_dump($roles);
            $error=false;
            if ($modelMenu->save()):
                $error=false;
                return array("response" => true, "id" => $modelMenu->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            else:
                $this->callback(1,$idmenu,$modelMenu->errors,"Menu_admin -> Nuevo");
                //var_dump($modelRol->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            endif;
        else:
            $this->callback(1,0,"NO POST","Menu_admin -> Nuevo");
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;
        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Actualizar($id,$roles)
    {
        //$date = date("Y-m-d H:i:s");
        $idmenu=0;
        $modelMenu= Menuadmin::find()->where(["id"=>$id])->one();
        $result=false;
        if ($roles):
            if ($modelMenu):
                $modelMenu->nombre=$roles["nombre"];
                $modelMenu->icono=$roles["icono"];
                $modelMenu->link=$roles["link"];
                $modelMenu->orden=$roles["orden"];
                $modelMenu->idparent=$roles["superior"];
                $modelMenu->usuariom=Yii::$app->user->identity->id;
                //$modelMenu->fechacreacion=$roles->idfactura;
                //var_dump($roles);
                $error=false;
                if ($modelMenu->save()):
                    $error=false;
                    return array("response" => true, "id" => $modelMenu->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);
                else:
                    $this->callback(1,$idmenu,$modelMenu->errors,"Menu_admin -> Actualizar");
                    //var_dump($modelRol->errors);
                    return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
                endif;
            else:

            endif;
        else:
            $this->callback(1,0,"NO POST","Menu_admin -> Actualizar");
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
        endif;
        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function callback($tipo,$id,$error,$funcion)
    {
        switch ($tipo) {
            case 1:
                $log= new Log_errores;
                $observacion="ID: ".$id;
                $log->Nuevo("MENU ADMIN",$error,$observacion,0,Yii::$app->user->identity->id);

                return true;
                break;

            default:
                # code...
                break;
        }
    }



}