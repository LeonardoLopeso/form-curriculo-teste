<div class="overlay">
    <h2>Formulário de envio de currículo</h2>
  </div>
  <div class="container center">
    <div class="form-wraper"> 
      <div class="row">
        <form method="post" enctype="multipart/form-data" class="row g-3">
          <div class="">
            <span></span>
              <h3>Preencha os campos e anexe seu currículo</h3>
              <?php 
                if (isset($_SESSION['formEnv'])) {
                  $enviado = $_SESSION['formEnv'];
                  echo '<div id="form" class="alert alert-success" role="alert">'.$enviado.'</div>';
                }
                if (isset($_SESSION['preenchaCampos'])) {
                  $campoVazio = $_SESSION['preenchaCampos'];
                  echo '<div id="formInfo" class="alert alert-primary" role="alert">'.$campoVazio.'</div>';
                }
              ?>
            </div>
          <div class="col-md-12">
            <label for="inputNome4" class="form-label">Nome<span style="color:red;">*</span></label>
            <input type="text" name="nome" class="form-control" id="inputNome4">
          </div>
          <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email<span style="color:red;">*</span></label>
            <input type="email" name="email" class="form-control" id="inputEmail4">
          </div>
          <div class="col-md-6">
            <label for="inputTelefone4" class="form-label">Telefone<span style="color:red;">*</span></label>
            <input type="text" name="telefone" class="form-control" id="inputTelefone4">
          </div>
          <div class="col-12">
            <label for="inputCargo" class="form-label">Cargo desejado<span style="color:red;">*</span></label>
            <input type="text" name="cargo" class="form-control" id="inputNome4">
          </div>
          <div class="col-md-6">
            <label for="inputState" class="form-label">Escolaridade<span style="color:red;">*</span></label>
            <select name="escolaridade" id="inputState" class="form-select">
              <option selected>Fundamental completo</option>
              <option>Fundamental incompleto</option>
              <option>Ensino médio completo</option>
              <option>Ensino médio incompleto</option>
              <option>Ensino superior completo</option>
              <option>Ensino superior incompleto</option>
            </select>
          </div>
          <div class="col-md-12">
            <input type="file" name="curriculo" class="form-control" aria-label="file example" required>
          </div>
          <div class="col-12">
            <label for="inputAddress2" class="form-label">Observações</label>
            <textarea name="obs" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <div class="col-12">
            <button type="submit" name="curriculo" class="btn btn-primary">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>