<?php
$shi_codigo=$_SESSION['shi_codigo'];
$shi_nombre=strtoupper($_SESSION['cod_usuario']);

date_default_timezone_set('America/El_Salvador');
?>

<!--Menu Procesos-->
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-ellipsis-h"></i>
    <p>
      Procesos
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=guia&accion=ingreso'>
        <i class="far fa-circle nav-icon"></i>
        <p>Ingreso de Gu&iacute;as</p>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=os'>
        <i class="far fa-circle nav-icon"></i>
        <p>Orden de Servicio</p>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=ar'>
        <i class="far fa-circle nav-icon"></i>
        <p>Arribo - AR</p>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=ld'>
        <i class="far fa-circle nav-icon"></i>
        <p>Salida a Ruta - LD</p>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=dl'>
        <i class="far fa-circle nav-icon"></i>
        <p>Entregas - DL</p>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=dv'>
        <i class="far fa-circle nav-icon"></i>
        <p>Devoluciones - DV</p>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=carga_xls'>
        <i class="far fa-circle nav-icon"></i>
        <p>Carga Base Envios</p>
      </a>
    </li>
  
  </ul>
</li>
<!--Menu Consultas-->
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-search "></i>
    <p>
      Consultas
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=movimientos'>
        <i class="far fa-circle nav-icon"></i>
        <p>Consulta de movimientos</p>
      </a>
    </li>


  </ul>
</li>
<!--Menu Reportes-->
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon far fa-copy"></i>
    <p>
      Reportes e Informes
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=repor_ingresos1'>
        <i class="far fa-circle nav-icon"></i>
        <p>Reporte de ingresos</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=reportehistorico'>
        <i class="far fa-circle nav-icon"></i>
        <p>Reporte de ingresos historico</p>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=informe1'>
        <i class="far fa-circle nav-icon"></i>
        <p>Informe general</p>
      </a>
    </li>


  </ul>
</li>
<!--Menu Mantenimientos-->
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon far fa-edit"></i>
    <p>
      Mantenimiento
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=mant&accion=agencias'>
        <i class="far fa-circle nav-icon"></i>
        <p>Agencias</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=mant&accion=ccostos'>
        <i class="far fa-circle nav-icon"></i>
        <p>Centros de Costos</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=mant&accion=zonas'>
        <i class="far fa-circle nav-icon"></i>
        <p>Zonas</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=mant&accion=mensajero'>
        <i class="far fa-circle nav-icon"></i>
        <p>Mensajeros</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=mant&accion=usuarios'>
        <i class="far fa-circle nav-icon"></i>
        <p>Usuarios</p>
      </a>
    </li>

  </ul>
</li>










