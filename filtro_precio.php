<?php
include('config/conexion.php');
if(isset($_POST["action"]))
{
    $query = $conexion->query("SELECT * FROM producto");

    if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
    {
        $query = $conexion->query("SELECT * FROM producto WHERE PRECIO BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'");
    }
    $total_row = mysqli_num_rows($query);
    $output = '';
    if($total_row > 0){
        while ($row = $query->fetch_object()) {
            $output .= '
            <div class="card">
                <img src="data:image/jpg;base64,' . base64_encode($row->IMG) . '">
                <h4>' . $row->N_PRODUCTO . '</h4>
                <p><a>S/</a>' . $row->PRECIO . '</p>
                <button class="ver-detalle">Ver Detalle del Producto</button>
            </div>';
        }
    }else{
        $output = '<h3>No Data Found</h3>';
    }
    echo $output;
}
?>