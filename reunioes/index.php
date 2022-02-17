<?php
// Inicia sessões
session_start();
if (empty($_SESSION['email'])) {
    header('location:login.php');
}

include 'conexao.php';
?>

<body class="mt-0" style="overflow-x:hidden;background-image: linear-gradient(white,white, #cc353a,#414291);">
    <?php
    include 'menu.php';
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <div class="row"  style="width: 100%;">
        <div class="col-3">
            <div style="color: white !important; ">
                <table style="width:250px ;color: black !important;">
                    <tr style="background-color: white;color: black;">
                        <th>
                            <h2>Legenda</h2>
                        </th>
                    </tr>
                    <tr>
                        <td style="background-color:#FFD700 ;color: black;">Comercial</td>
                    </tr>
                    <tr>
                        <td style="background-color:#0071c5 ;">Compras</td>
                    </tr>
                    <tr>
                        <td style="background-color:#FF4500 ;">Expedição</td>
                    </tr>
                    <tr>
                        <td style="background-color:#8B4513 ;">Faturamento</td>
                    </tr>
                    <tr>
                        <td style="background-color:#ff007f ;">Financeiro</td>
                    </tr>
                    <tr>
                        <td style="background-color:#436EEE ;">Fiscal</td>
                    </tr>
                    <tr>
                        <td style="background-color:#A020F0 ;">Logística</td>
                    </tr>
                    <tr>
                        <td style="background-color:#40E0D0 ;">Marketing</td>
                    </tr>
                    <tr>
                        <td style="background-color:#228B22 ;">Recursos Humanos</td>
                    </tr>
                    <tr>
                        <td style="background-color:#8B0000 ;">Tecnologia da Informação</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-9" style="width: 100%;">
            <div style="background-color: white; color: white !important;" id='calendar'></div>
        </div>
    </div>
    <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes do Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="visevent">
                        <dl class="row">

                            <dt class="col-sm-3">Início:</dt>
                            <dd class="col-sm-9" id="start"></dd>

                            <dt class="col-sm-3">Fim:</dt>
                            <dd class="col-sm-9" id="end"></dd>

                            <dt class="col-sm-3">ID:</dt>
                            <dd class="col-sm-9" id="id"></dd>



                        </dl>
                        <button class="btn btn-warning btn-canc-vis">Editar</button>
                        <a href="" id="apagar_evento" class="btn btn-danger">Apagar</a>
                    </div>
                    <div class="formedit">
                        <span id="msg-edit"></span>
                        <form id="editevent" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Título do evento">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sala</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select class="form-control" name="sala">
                                            <option value="">Selecione</option>
                                         
                                            <option value='2'>Sala de Reunião prédio S</option>
                                            <option value='3'> Sala de Treinamento prédio J</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Setor</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Selecione</option>
                                        <option style="color:#FFD700;" value="#FFD700">Comercial</option>
                                        <option style="color:#0071c5;" value="#0071c5">Compras </option>
                                        <option style="color:#FF4500;" value="#FF4500">Expedição</option>
                                        <option style="color:#8B4513;" value="#8B4513">Faturamento</option>
                                        <option style="color:#ff007f;" value="#ff007f">Financeiro</option>
                                        <option style="color:#436EEE;" value="#436EEE">Fiscal</option>
                                        <option style="color:#A020F0;" value="#A020F0">Logística</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">Marketing</option>
                                        <option style="color:#228B22;" value="#228B22">Recursos Humanos</option>
                                        <option style="color:#8B0000;" value="#8B0000">Tecnologia da Informação</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nome Colaborador</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nome_usuario" class="form-control" id="nome_usuario" placeholder="Nome Colaborador">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Início do evento</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Final do evento</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end" class="form-control" id="end" onkeypress="DataHora(event, this)">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-primary btn-canc-edit">Cancelar</button>
                                    <button type="submit" name="CadEvent" id="CadEvent" value="CadEvent" class="btn btn-warning">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="msg-cad"></span>
                    <form id="addevent" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Título do evento">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Sala</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select class="form-control" name="sala">
                                        <option value="">Selecione</option>
                                        <option value='1'>Sala de Reunião prédio J</option>
                                        <option value='2'>Sala de Reunião prédio S</option>
                                        <option value='3'> Sala de Treinamento prédio J</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Setor</label>
                            <div class="col-sm-10">
                                <select name="color" class="form-control" id="color">
                                    <option value="">Selecione</option>
                                    <option style="color:#FFD700;" value="#FFD700">Comercial</option>
                                    <option style="color:#0071c5;" value="#0071c5">Compras </option>
                                    <option style="color:#FF4500;" value="#FF4500">Expedição</option>
                                    <option style="color:#8B4513;" value="#8B4513">Faturamento</option>
                                    <option style="color:#1C1C1C;" value="#1C1C1C">Financeiro</option>
                                    <option style="color:#436EEE;" value="#436EEE">Fiscal</option>
                                    <option style="color:#A020F0;" value="#A020F0">Logística</option>
                                    <option style="color:#40E0D0;" value="#40E0D0">Marketing</option>
                                    <option style="color:#228B22;" value="#228B22">Recursos Humanos</option>
                                    <option style="color:#8B0000;" value="#8B0000">Tecnologia da Informação</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nome Colaborador</label>
                            <div class="col-sm-10">
                                <input type="text" name="nome_usuario" class="form-control" id="nome_usuario" placeholder="Nome Colaborador">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Início do evento</label>
                            <div class="col-sm-10">
                                <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Final do evento</label>
                            <div class="col-sm-10">
                                <input type="text" name="end" class="form-control" id="end" onkeypress="DataHora(event, this)">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" name="CadEvent" id="CadEvent" value="CadEvent" class="btn btn-success">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>