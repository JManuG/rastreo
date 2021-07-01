<?php

include("historico.php");
$x1= new historico_ingresos();

if(isset($_POST['p1'])){

    $r1=$_POST['p1'];
    $r2=$_POST['p2'];
    $r3=$_POST['p3'];
    $r4=$_POST['p4'];
    $r5=$_POST['p5'];
    
    $x1->llenar_encuesta($r1,$r2,$r3,$r4,$r5);
  
}

$encuesta= $x1->encuesta();

if($encuesta==0){
?>

<div class="content-wrapper">
<br />
  <div class="container">
    <section class="row">
      <div class="col-md-12">
        <h1 class="text-center">Encuesta de satisfaccion.</h1>
       <h4> <p class="text-center">Favor completar la siguiente encuesta, para calificar <br>
        el funcionamiento de la aplicación de correspondencia interna, <br>
        tomando como base que 1 es muy malo y 5 es excelente.</p></h4>
      </div>
    </section>
    <hr><br />

    <!--  Servicios  -->
    <section class="row">
      <div class="col-md-12">
        <h3>Servicio.</h3>
        <p></p>
      </div>
    </section>
<form method="post" action="">
    <!--  PREGUNTA 1  -->
    <section class="row">
      <div class="col-md-12">
        <section class="row">
          <div class="col-md-5">
            <p>1.	¿Considera que el sistema es amigable?</p>
          </div>
          <div class="col-md-7">
          <table>
            <tr>
          <td style="width:50px"><label><input name="p1" type="radio" value="1" /> 1</label></td>
          <td style="width:50px"><label><input name="p1" type="radio" value="2" /> 2</label></td>
          <td style="width:50px"><label><input name="p1" type="radio" value="3" /> 3</label></td>
          <td style="width:50px"><label><input name="p1" type="radio" value="4" /> 4</label></td>
          <td style="width:50px"><label><input name="p1" type="radio" value="5" /> 5</label></td>
          </tr>
          </table>
          </div>
        </section>
      </div>
    </section><br />
    <hr />

    <!--  PREGUNTA 2 -->
    <section class="row">
      <div class="col-md-12">
        <section class="row">
          <div class="col-md-5">
            <p>2.	¿Esta satisfecho con la velocidad del sistema?</p>
          </div>
          <div class="col-md-7">
          <table>
            <tr>
          <td style="width:50px"><label><input name="p2" type="radio" value="1" /> 1</label></td>
          <td style="width:50px"><label><input name="p2" type="radio" value="2" /> 2</label></td>
          <td style="width:50px"><label><input name="p2" type="radio" value="3" /> 3</label></td>
          <td style="width:50px"><label><input name="p2" type="radio" value="4" /> 4</label></td>
          <td style="width:50px"><label><input name="p2" type="radio" value="5" /> 5</label></td>
          </tr>
          </table>
          </div>
        </section>
      </div>
    </section><br />
    <hr />

<!--  PREGUNTA 3.  -->
<section class="row">
      <div class="col-md-12">
        <section class="row">
          <div class="col-md-5">
            <p>3.	¿El sistema le muestra información útil?</p>
          </div>
          <div class="col-md-7">
          <table>
            <tr>
          <td style="width:50px"><label><input name="p3" type="radio" value="1" /> 1</label></td>
          <td style="width:50px"><label><input name="p3" type="radio" value="2" /> 2</label></td>
          <td style="width:50px"><label><input name="p3" type="radio" value="3" /> 3</label></td>
          <td style="width:50px"><label><input name="p3" type="radio" value="4" /> 4</label></td>
          <td style="width:50px"><label><input name="p3" type="radio" value="5" /> 5</label></td>
          </tr>
          </table>
          </select>
          </div>
        </section>
      </div>
    </section><br />
    <hr />

<!--  PREGUNTA 4  -->
<section class="row">
      <div class="col-md-12">
        <section class="row">
          <div class="col-md-5">
            <p>4.	¿puede decirnos su nivel de satisfacción con el sistema?</p>
          </div>
          <div class="col-md-7">
          <table>
            <tr>
          <td style="width:50px"><label><input name="p4" type="radio" value="1" /> 1</label></td>
          <td style="width:50px"><label><input name="p4" type="radio" value="2" /> 2</label></td>
          <td style="width:50px"><label><input name="p4" type="radio" value="3" /> 3</label></td>
          <td style="width:50px"><label><input name="p4" type="radio" value="4" /> 4</label></td>
          <td style="width:50px"><label><input name="p4" type="radio" value="5" /> 5</label></td>
          </tr>
          </table>
          </select>
          </div>
        </section>
      </div>
    </section><br />
    <hr />



    <!--  Comentarios  -->
    <section class="row">
      <div class="col-md-12">
        <h3>Comentarios.</h3>
        <p></p>
      </div>
    </section>
    <section class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="comment">Comentarios:</label>
          <textarea class="form-control" rows="6" id="p5" name="p5" maxlength="249"></textarea>
        </div>
      </div>
    </section>
    <section class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-info" id="saveForm" >Guardar Encuesta</button>
        <button type="button" class="btn btn-danger" id="clearForm">Limpiar formulario</button>
      </div>
    </section>
  </div>

  <br /><br />
</div>
</form>

<?php
}
?>