<?php
include 'conexao.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendario";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sala = $_POST['sala'];
$data = $_POST['data'];
session_start();
if(empty($_SESSION['email'])){
    header('location:login.php');
}
?>
<body id="container" class="mt-0"  >
<?php
    include 'menu.php';
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}


?>
<div class="row" style=" text-align: center;">
    <div class="col-1" >

    </div>
    <div class="col-10">
<?php
   
if (!empty($sala)) {
    $sql = "SELECT * FROM events WHERE sala LIKE '%$sala%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id_events = $row["id"];

            $query_events = "SELECT * FROM events where id = $id_events AND DATE_ADD(start , INTERVAL 30 DAY);";
                
                $result2 = $conn->query($query_events);

                if ($result2->num_rows > 0) {
                    while($row_events = $result2->fetch_assoc()) {
                        $id = $row_events['id'];
                        $title = $row_events['title'];
                        $color = $row_events['color'];
                        $start = $row_events['start'];
                        $end = $row_events['end'];
                        $sala = $row_events['sala'];
                        $nome_user = $row_events['nome_usuario'];
                        
                        $eventos[] = [
                            'id' => $id, 
                            'title' => $title, 
                            'color' => $color, 
                            'start' => $start, 
                            'end' => $end, 
                            'sala' => $sala,
                            'nome_usuario' => $nome_user,
                            
                        ];
                      
                    }
                }
             

           
        }
        echo "
        
            <div class='margin mb-5'>
                <form action='pesquisar.php' method='POST' style class='form-inline my-2 my-lg-0 float-right'>
                     <div class='form-group row'>
                    <div class='col-sm-10'>
                        <div class='form-group'>
                            <select class='form-control' name='sala' >
                                <option value=''>SALAS</option>	
                                <option value='1' >Sala de Reunião prédio J</option>
                                <option value='2'>Sala de Reunião prédio S</option>
                                <option value='3'> Sala de Treinamento prédio J</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <input name='data' class='form-control mr-sm-2' type='date' placeholder='Pesquisar Data' >
                    <button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Pesquisar</button>
                </form>
            </div>
            <table class='table'>
            <thead class='thead-dark'>
            <tr>
                <th style='width: 80px !important;' scope='col-1'>Id</th>
                <th  style='width: 80px !important;' scope='col-2'>Título</th>
                <th  style='width: 80px !important;' scope='col-2'>Setor</th>
                <th  style='width: 200px !important;' scope='col-2'>Inìcio</th>
                <th  style='width: 200px !important;' scope='col-2'>Fim</th>
                <th  style='width: 80px !important;' scope='col-2'>Sala</th>
                <th  style='width: 200px !important;' scope='col-1'>Id Usúario</th>
            </tr>
        </thead>
                <tbody>";
                foreach ($eventos as $row_events){ ?>
                    <tr>
                        <td><?php echo $row_events['id']; ?></td>
                        
                        
                        <td><?php echo $row_events['title']; ?></td>
                       <?php if($row_events['color'] == "#FFD700"){
                            ?> <td> Comercial</td> <?php
                        }
                        elseif ($row_events['color'] == "#0071c5"){
                            ?> <td> Compras</td> <?php
                        }
                        elseif ($row_events['color'] == "#FF4500"){
                            ?> <td> Expedição</td> <?php
                        }
                        elseif ($row_events['color'] == "#8B4513"){
                            ?> <td> Faturamento</td> <?php
                        }
                        elseif ($row_events['color'] == "#ff007f"){
                            ?> <td> Financeiro</td> <?php
                        }
                        elseif ($row_events['color'] == "#436EEE"){
                            ?> <td> Fiscal</td> <?php
                        }
                        elseif ($row_events['color'] == "#A020F0"){
                            ?> <td> Logística</td> <?php
                        }
                        elseif ($row_events['color'] == "#40E0D0"){
                            ?> <td> Marketing</td> <?php
                        }
                        elseif ($row_events['color'] == "#228B22"){
                            ?> <td> Recursos Humanos</td> <?php
                        }
                        else{
                            ?> <td>Tecnologia da Informação</td> <?php
                        }   ?>
                        <td><?php echo date("d-m-y H:i:s", strtotime($row_events['start'])); ?></td>
                        <td><?php echo date("d-m-y H:i:s", strtotime($row_events['end'])); ?></td>
                        
                        <?php
                        if($row_events['sala'] == 1){?>
                            <td><?php echo"Sala de Reunião prédio J";?> </td>
                            <?php
                        }
                    
                   
                        elseif($row_events['sala'] == 2){?>
                            <td><?php echo"Sala de Reunião prédio S";?> </td>
                            <?php
                        }
                        else{
                            ?><td><?php echo" Sala de Treinamento prédio J";?> </td><?php
                        }
                    
                    ?>
                        <td><?php echo $row_events['nome_usuario']; ?></td>
        
                            
                        
                            
                        </tr>
                        <?php } ?>              
                    
                    </tbody>
                </table>
            </div>
        <div class="col-1">
        </div>
    </div>
</body> <?php     
            
    }
    
}
else if(!empty($data)) {
    $sql2 = "SELECT * FROM events WHERE start LIKE '%$data%'";
  
    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id_events = $row["id"];

            $query_events = "SELECT * FROM events where id = $id_events AND DATE_ADD(start , INTERVAL 30 DAY);";
                
                $result2 = $conn->query($query_events);

                if ($result2->num_rows > 0) {
                    while($row_events = $result2->fetch_assoc()) {
                        $id = $row_events['id'];
                        $title = $row_events['title'];
                        $color = $row_events['color'];
                        $start = $row_events['start'];
                        $end = $row_events['end'];
                        $sala = $row_events['sala'];
                        $nome_user = $row_events['nome_usuario'];
                        
                        $eventos[] = [
                            'id' => $id, 
                            'title' => $title, 
                            'color' => $color, 
                            'start' => $start, 
                            'end' => $end, 
                            'sala' => $sala,
                            'nome_usuario' => $nome_user,
                            
                        ];
                      
                    }
                }
             

           
        }
        echo "
        
            <div class='margin mb-5'>
                <form action='pesquisar.php' method='POST' style class='form-inline my-2 my-lg-0 float-right'>
                     <div class='form-group row'>
                    <div class='col-sm-10'>
                        <div class='form-group'>
                            <select class='form-control' name='sala' >
                                <option value=''>SALAS</option>	
                                <option value='1' >Sala de Reunião prédio J</option>
                                <option value='2'>Sala de Reunião prédio S</option>
                                <option value='3'> Sala de Treinamento prédio J</option>
                            </select>
                        </div>
                    </div>
                </div>
                    <input name='data' class='form-control mr-sm-2' type='date' placeholder='Pesquisar Data' >
                    <button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Pesquisar</button>
                </form>
            </div>
            <table class='table'>
            <thead class='thead-dark'>
            <tr>
                <th style='width: 80px !important;' scope='col-1'>Id</th>
                <th  style='width: 80px !important;' scope='col-2'>Título</th>
                <th  style='width: 80px !important;' scope='col-2'>Setor</th>
                <th  style='width: 200px !important;' scope='col-2'>Inìcio</th>
                <th  style='width: 200px !important;' scope='col-2'>Fim</th>
                <th  style='width: 80px !important;' scope='col-2'>Sala</th>
                <th  style='width: 200px !important;' scope='col-1'>Id Usúario</th>
            </tr>
        </thead>
                <tbody>";
                foreach ($eventos as $row_events){ ?>
                    <tr>
                        <td><?php echo $row_events['id']; ?></td>
                        
                        
                        <td><?php echo $row_events['title']; ?></td>
                       <?php if($row_events['color'] == "#FFD700"){
                            ?> <td> Comercial</td> <?php
                        }
                        elseif ($row_events['color'] == "#0071c5"){
                            ?> <td> Compras</td> <?php
                        }
                        elseif ($row_events['color'] == "#FF4500"){
                            ?> <td> Expedição</td> <?php
                        }
                        elseif ($row_events['color'] == "#8B4513"){
                            ?> <td> Faturamento</td> <?php
                        }
                        elseif ($row_events['color'] == "#ff007f"){
                            ?> <td> Financeiro</td> <?php
                        }
                        elseif ($row_events['color'] == "#436EEE"){
                            ?> <td> Fiscal</td> <?php
                        }
                        elseif ($row_events['color'] == "#A020F0"){
                            ?> <td> Logística</td> <?php
                        }
                        elseif ($row_events['color'] == "#40E0D0"){
                            ?> <td> Marketing</td> <?php
                        }
                        elseif ($row_events['color'] == "#228B22"){
                            ?> <td> Recursos Humanos</td> <?php
                        }
                        else{
                            ?> <td>Tecnologia da Informação</td> <?php
                        }   ?>
                        <td><?php echo date("d-m-y H:i:s", strtotime($row_events['start'])); ?></td>
                        <td><?php echo date("d-m-y H:i:s", strtotime($row_events['end'])); ?></td>
                        
                        <?php
                        if($row_events['sala'] == 1){?>
                            <td><?php echo"Sala de Reunião prédio J";?> </td>
                            <?php
                        }
                    
                   
                        elseif($row_events['sala'] == 2){?>
                            <td><?php echo"Sala de Reunião prédio S";?> </td>
                            <?php
                        }
                        else{
                            ?><td><?php echo" Sala de Treinamento prédio J";?> </td><?php
                        }
                    
                    ?>
                        <td><?php echo $row_events['nome_usuario']; ?></td>
        
                            
                        
                            
                        </tr>
                        <?php } ?>              
                    
                    </tbody>
                </table>
            </div>
        <div class="col-1">
        </div>
    </div>
</body> <?php     
            
    }
}
else{
    echo "<div class='alert alert-danger' role='alert'>
    This is a danger alert with <a href='#' class='alert-link'>an example link</a>. Give it a click if you like.
  </div>";
}
?>