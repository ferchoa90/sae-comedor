<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use backend\models\Factura;
use backend\models\Facturadetalle;
use common\models\Empresa;
use common\models\Cuentas;
use common\models\Diario;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 04/03/22
 * Time: 23:10
 */

class Facturacion_electronica extends Component
{

    //public $secuencial = "87654321";
    public $secuencial;
    public $emision;

    function __construct($secuencial='87654321',$emision=1)
    {
        $this->secuencial=$secuencial;
        $this->emision=$emision;
    }

    function getClavedeacceso($fecha,$tipocomp='01',$serie,$factura)
    {
        //$CAacceso = ClaveAcceso($fecha,"01","0890006248001","2",$serie,$factura,"12345678","1");
        $claveAcceso= $this->generarClave($fecha,$tipocomp,$serie,$factura);
        return $claveAcceso;
    }

    function getGenerarxml()
    {

    }

    protected function getAmbiente($empresa)
    {
        $ruc= Empresa::find()->where(["id"=>$empresa,"estatus"=>"ACTIVO"])->one();
        if ($ruc)
        {
            return $ruc->ambiente;
        }
        else{
            return "No hay ambiente configurado";
        }
    }

    protected function getSerie($empresa)
    {
        $serie= Empresa::find()->where(["id"=>$empresa,"estatus"=>"ACTIVO"])->one();
        if ($serie)
        {
            return str_replace("-","",$serie->serie);
        }
        else{
            return "No hay ambiente configurado";
        }
    }

    protected function generarClave($fecha,$tipocomp,$serie,$factura){
        // Formato ddmmaaaa + tipo comprobante + numeroruc + tipoambiente + serie + ncomprobante + codigonumero + tipoemision + digitoverificador
        // Tipo comprobante 01 -> Factura, 02 -> Liquidación de C., 03 -> Nota de Crédito, 04 -> Nota de Débito, 05 -> Guía de Rem., 06 -> Comprobante de Ret.
        if ($fecha)
        {
            $valfecha=$this->verificarFecha($fecha);

            if ($valfecha){
                $returnfecha= $this->getFecha($fecha);
                $tipocomp= $this->getformatoTipocomprobante($tipocomp);
                $ruc=$this->getRuc(2);
                $ambiente=$this->getAmbiente(2);
                $serie=$this->getSerie(2);
                $factura=$this->getformatoFactura($factura);
                $clave=$returnfecha.$tipocomp.$ruc.$ambiente.$serie.$factura.$this->formato($this->secuencial,8).$this->emision;
                $verificador = $this->getVerificador($clave);
                $clave = $clave . $verificador;
                $response=$clave;
                //$response=$clave;
            }else{
                $response = "Error en el formato de fecha";
            }
        }else{
            $response = "La fecha no puede estar vacia";
        }
        return $response;
    }

    protected function getRuc($empresa=2){
        $ruc= Empresa::find()->where(["id"=>$empresa,"estatus"=>"ACTIVO"])->one();
        if ($ruc)
        {
            return $ruc->ruc;
        }
        else{
            return "No hay empresa configurada";
        }
    }

    protected function getformatoTipocomprobante($tipo)
    {
        $tcomp = $tipo;
        $tcomp = sprintf("%02d", $tcomp);
        return $tcomp;
    }

    protected function getformatoFactura($nfactura)
    {
        $nfactura = $nfactura;
        $nfactura = sprintf("%09d", $nfactura);
        return $nfactura;
    }


    protected function getFecha($fecha){
        $anio=substr($fecha,0,4);
        $sep1=substr($fecha,4,1);
        $mes=substr($fecha,5,2);
        $sep2=substr($fecha,7,1);
        $dia=substr($fecha,8,2);
        return $dia.$mes.$anio;
    }

    protected function verificarFecha($fecha)
    {
        $vdia=false;$vmes=false;$vanio=false;
        $anio=substr($fecha,0,4);
        $sep1=substr($fecha,4,1);
        $mes=substr($fecha,5,2);
        $sep2=substr($fecha,7,1);
        $dia=substr($fecha,8,2);
        switch ($dia) {
            case ($dia <= 31):
                $vdia=true;
                break;

            default:
                $vdia=false;
                break;
        }

        switch ($mes) {
            case ($mes <= 12):
                $vmes=true;
                break;

            default:
                $vmes=false;
                break;
        }

        switch ($anio) {
            case ($anio >=2010 && $anio <= 2099):
                $vanio=true;
                break;

            default:
                $vanio=false;
                break;
        }
        if ($vdia && $vmes && $vanio){
            return true;
        }else{
            return false;
        }


    }

    protected function IdFactura($fecha,$comprobante,$ruc,$ambiente,$serie,$num_factura,$cod_numerico,$emision){
        $Cadena 		= "";
        $verificador 	= "";
        $Cadena = str_replace("/", "", $fecha) . $comprobante . $ruc . $ambiente . str_replace("-","",$serie) .
		$this->formato($num_factura, 9) . $this->formato($cod_numerico, 8) . $emision;
		$verificador = $this->getVerificador($Cadena);
        $Cadena = $Cadena . $verificador;
        return $Cadena;
    }

    protected function formato($number,$num) {
		$number ="000000000000".$number;
		$number = substr($number, strlen($number)-$num,strlen($number));
		return $number;
	}

    protected function getVerificador($cadena){
    	$sum=0;
        $lim = array(2, 3, 4, 5, 6, 7, 2, 3, 4, 5, 6, 7, 2, 3, 4, 5, 6, 7, 2, 3, 4, 5, 6, 7, 2, 3, 4,
		5, 6, 7, 2, 3, 4, 5, 6, 7, 2, 3, 4, 5, 6, 7, 2, 3, 4, 5, 6, 7, 2);
		$cadena = $this->voltearCadena($cadena);
		for( $i = 0; $i <= 47; $i++):
            $num = substr($cadena, $i, 1);
            $por = $num * $lim[$i];
            $sum = $sum + $por;
        endfor;
		$mood = $sum % 11;
        $resul = 11 - $mood;
        if( $resul == 10 ):
            $resul = 1;
        endif;
        if( $resul == 11):
			$resul = 0;
		endif;
        return $resul;
	}

    protected function voltearCadena($cadena){
        $cadenaInvertida = "";
        $i = strlen($cadena) - 1;
        for($a = 0; $a <= 48; $a++):
            $cadenaInvertida = $cadenaInvertida . substr($cadena, ($i + 1), 1); $i -= 1;
        endfor;
        return $cadenaInvertida;
	}

    function getDatosfactuacion($emp)
    {


    }





    function getAutorizaXML($claveAcceso){
        try {
            $client = new \mongosoft\soapclient\Client([
                'url' => "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl",
                //'url' => "https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl",
                //'url' => "https://cel.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl",
            ]);
            //$url = "https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl";
            $params =array("claveAccesoComprobante"=>$claveAcceso);
            //$client =new SoapClient($url);
            $result = $client->autorizacionComprobante($params);
        } catch (Exception $e) {
                $msn = 'Excepción capturada: '.$e->getMessage();
        }
        return $result;
    }

    public function setCrearfactura($name,$xml,$ruta=""){
	//	$directorio  = $ruta."E:/xampp-new/htdocs/sae-bagsacorp/backend/web/xml/$name.xml";
	//	$directorio2 = $ruta."E:/xampp-new/htdocs/sae-bagsacorp/backend/web/xml_autorizado/$name.xml";

        $directorio  = $ruta."C:/xampp/htdocs/sae-bagsacorp/backend/web/xml/$name.xml";
		$directorio2 = $ruta."C:/xampp/htdocs/sae-bagsacorp/backend/web/xml_autorizado/$name.xml";
		if (!file_exists($directorio2)):
			if (!file_exists($directorio)):
				date_default_timezone_set("America/Bogota");
				$fd = fopen ($directorio, "a");
				fwrite ($fd, $xml);
				fclose($fd);
			endif;
		endif;
	}

    protected function facturaPrueba($claveacceso='2022030701093017846200110010010000000348765432117',$subtotal,$iva,$total,$identificacion,$cliente,$direccion){
        $Cabecera = array(
            "ambiente"				=> "1",
            "tipoEmision"			=> "1",
            "razonSocial"			=> "MARIO FERNANDO AGUILAR JIMÉNEZ",
            "nombreComercial"		=> "MARIO FERNANDO AGUILAR JIMÉNEZ",
            "ruc"					=> "0930178462001",
            "claveAcceso"			=> $claveacceso,
            "codDoc"				=> "01",
            "estab"					=> substr($claveacceso,24,3),
            "ptoEmi"				=> substr($claveacceso,27,3),
            "secuencial"			=> substr($claveacceso,30,9),
            "dirMatriz"				=> "EVA ROMÁN Y LEGARDA",
            "fechaEmision"			=> date("d/m/Y"),
            "dirEstablecimiento"			=> "EVA ROMÁN Y LEGARDA", //sucursal direccion
            "obligadoContabilidad"			=> "NO",
            "tipoIdentificacionComprador"	=> "05",
            "razonSocialComprador"			=> $cliente,
            "identificacionComprador"		=> $identificacion,
            "base0"							=> "0.00",
            "base12"						=> $subtotal,
            "monto_iva"						=> $iva,
            "descuento"						=> 0,
            "propina"						=> 0,
            "importeTotal"					=> $total,
            "moneda"						=> "DOLAR",
            "formaPagoId"					=> "01",
            "formaPagoDescrip"				=> "EFECTIVO",
            "valorRetIva"					=> 0,
            "valorRetRenta"					=> 0,
            "Direccion"						=> $direccion,
            "Email"							=> "marioaguilar1990@gmail.com",
            "placa"							=> "",
            "Fono"							=> "",
            "Usuario"						=> "maguilar",
            "tip_venta"						=> "CONTADO",
            "documen"						=> "01");

            return $Cabecera;
    }

    public function getXml($Cabecera='',$Detalle='',$porcen_iva='12.00',$subtotal,$iva,$total,$identificacion,$cliente,$direccion){
        //if ($Cabecera){ $Cabecera=$this->facturaPrueba;  }
        $Cabecera=$this->facturaPrueba('2022031401093017846200110010010000000048765432114',$subtotal,$iva,$total,$identificacion,$cliente,$direccion);
        $porcen_iva='12.00';
        //var_dump($Cabecera);
		$totalSinImpuestos = $Cabecera['base0'] + $Cabecera['base12'];
		$importeTotal = $totalSinImpuestos + $Cabecera['monto_iva'] - $Cabecera['descuento'];

    	$compensacion=0;

		$cod_porcen = 2;
		$porcentaje	= $porcen_iva * 100;
		$xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<factura id="comprobante" version="1.0.0">
    <infoTributaria>
        <ambiente>'.$Cabecera['ambiente'].'</ambiente>
        <tipoEmision>'.$Cabecera['tipoEmision'].'</tipoEmision>
        <razonSocial>'.$Cabecera['razonSocial'].'</razonSocial>
        <nombreComercial>'.$Cabecera['nombreComercial'].'</nombreComercial>
        <ruc>'.$Cabecera['ruc'].'</ruc>
        <claveAcceso>'.$Cabecera['claveAcceso'].'</claveAcceso>
        <codDoc>'.$Cabecera['codDoc'].'</codDoc>
        <estab>'.$Cabecera['estab'].'</estab>
        <ptoEmi>'.$Cabecera['ptoEmi'].'</ptoEmi>
        <secuencial>'.$Cabecera['secuencial'].'</secuencial>
        <dirMatriz>'.$Cabecera['dirMatriz'].'</dirMatriz>
		<regimenMicroempresas>CONTRIBUYENTE RÉGIMEN MICROEMPRESAS</regimenMicroempresas>
		<agenteRetencion>1</agenteRetencion>
    </infoTributaria>
    <infoFactura>
        <fechaEmision>'.$Cabecera['fechaEmision'].'</fechaEmision>
        <dirEstablecimiento>'.$Cabecera['dirEstablecimiento'].'</dirEstablecimiento>
        <obligadoContabilidad>'.$Cabecera['obligadoContabilidad'].'</obligadoContabilidad>
        <tipoIdentificacionComprador>'.$Cabecera['tipoIdentificacionComprador'].'</tipoIdentificacionComprador>
        <razonSocialComprador>'.$Cabecera['razonSocialComprador'].'</razonSocialComprador>
        <identificacionComprador>'.$Cabecera['identificacionComprador'].'</identificacionComprador>
        <totalSinImpuestos>'.number_format($totalSinImpuestos,2,".","").'</totalSinImpuestos>
        <totalDescuento>'.number_format($Cabecera['descuento'],2,".","").'</totalDescuento>
        <totalConImpuestos>';

		if($Cabecera['base12'] > 0):
	$xml .='
            <totalImpuesto>
                <codigo>2</codigo>
                <codigoPorcentaje>'.$cod_porcen.'</codigoPorcentaje>
                <baseImponible>'.number_format($Cabecera['base12'],2,".","").'</baseImponible>
                <valor>'.number_format($Cabecera['monto_iva'],2,".","").'</valor>
            </totalImpuesto>';
		endif;
		if($Cabecera['base0'] > 0):
	$xml .='
            <totalImpuesto>
                <codigo>2</codigo>
                <codigoPorcentaje>0</codigoPorcentaje>
                <baseImponible>'.number_format($Cabecera['base0'],2,".","").'</baseImponible>
                <valor>0</valor>
            </totalImpuesto>';
		endif;
$xml .='
	</totalConImpuestos>';

		if($compensacion > 0):
$xml .='
		<compensaciones>
            <compensacion>
                <codigo>1</codigo>
                <tarifa>2</tarifa>
                <valor>'.number_format($compensacion,2,".","").'</valor>
            </compensacion>
        </compensaciones>';
		endif;

$xml .='
		<propina>'.number_format($Cabecera['propina'],2,".","").'</propina>
    	<importeTotal>'.number_format($importeTotal,2,".","").'</importeTotal>
    	<moneda>'.$Cabecera['moneda'].'</moneda>
		<pagos>
            <pago>
                <formaPago>'.$Cabecera['formaPagoId'].'</formaPago>
                <total>'.number_format($Cabecera['importeTotal'],2,".","").'</total>
            </pago>
        </pagos>
        <valorRetIva>'.number_format($Cabecera['valorRetIva'],2,".","").'</valorRetIva>
        <valorRetRenta>'.number_format($Cabecera['valorRetRenta'],2,".","").'</valorRetRenta>
    </infoFactura>
    <detalles>';

	foreach($Detalle as $row):
$xml .='
        <detalle>
            <codigoPrincipal>PROD'.$row['prod'].'</codigoPrincipal>
            <codigoAuxiliar>PROD'.$row['prod'].'-'.$row['linea'].'</codigoAuxiliar>
            <descripcion>'.$row['des_prod'].'</descripcion>
            <cantidad>'.$row['cant'].'</cantidad>
            <precioUnitario>'.number_format($row['precio'],2,".","").'</precioUnitario>
            <descuento>'.number_format($row['descu'],2,".","").'</descuento>
            <precioTotalSinImpuesto>'.number_format(($row['precio']*$row['cant']),2,".","").'</precioTotalSinImpuesto>
            <impuestos>';
			if($row['valor_iva'] > 0):
			$xml .='
                <impuesto>
                    <codigo>2</codigo>
                    <codigoPorcentaje>'.$cod_porcen.'</codigoPorcentaje>
                    <tarifa>'.number_format($porcentaje,2).'</tarifa>
                    <baseImponible>'.number_format(($row['precio']*$row['cant']),2,".","").'</baseImponible>
                    <valor>'.number_format($row['valor_iva'],2,".","").'</valor>
                </impuesto>';
			else:
			$xml .='
                <impuesto>
                    <codigo>2</codigo>
                    <codigoPorcentaje>0</codigoPorcentaje>
                    <tarifa>0.00</tarifa>
                    <baseImponible>'.number_format(($row['precio']*$row['cant']),2,".","").'</baseImponible>
                    <valor>0.00</valor>
                </impuesto>';
			endif;
			$xml .='
            </impuestos>
        </detalle>';
	endforeach;
$xml .='
    </detalles>
    <infoAdicional>
        <campoAdicional nombre="Direccion">'.($Cabecera['Direccion']=='' ? '-' : $Cabecera['Direccion']).'</campoAdicional>
        <campoAdicional nombre="Email">'.($Cabecera['Email']=='' ? '-' : $Cabecera['Email']).'</campoAdicional>
        <campoAdicional nombre="Fono">'.($Cabecera['Fono']=='' ? '-' : $Cabecera['Fono']).'</campoAdicional>
        <campoAdicional nombre="Usuario">'.($Cabecera['Usuario']=='' ? '-' : $Cabecera['Usuario']).'</campoAdicional>
    </infoAdicional>
</factura>';


    $obj = simplexml_load_string($xml);
    //var_dump($xml);
    //var_dump($obj);
		//$obj->infoFactura->razonSocialComprador = $Cabecera['razonSocial'];
		return $obj;
	}

}