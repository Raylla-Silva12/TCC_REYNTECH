
<?php 
// File upload folder 
$uploadDir = 'saves/'; 
 
// Allowed file types 
$allowTypes = array('jpg', 'png', 'jpeg'); 
 
// Default response 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
 
// If form is submitted 
if(isset($_POST['nomeProduto']) || isset($_POST['valorProduto']) || isset($_POST['descricaoProduto']) || isset($_POST['qtdProduto']) || isset($_POST['file']) || isset($_POST['categoriaProduto'])){ 
    // Get the submitted form data 
    $nomeProduto = $_POST['nomeProduto']; 
    $valorProduto = $_POST['valorProduto']; 
    $descricaoProduto = $_POST['descricaoProduto']; 
    $qtdProduto = $_POST['qtdProduto']; 
    $categoriaProduto = $_POST['categoriaProduto'];
     
    // Check whether submitted data is not empty 
    if(!empty($nomeProduto) && !empty($valorProduto) && !empty($descricaoProduto) && !empty($qtdProduto) && !empty($categoriaProduto)){ 
            $uploadStatus = 1; 
             
            // Upload file 
            $uploadedFile = ''; 
            if(!empty($_FILES["file"]["name"])){ 
                // File path config 
                $fileName = basename($_FILES["file"]["name"]); 
                $targetFilePath = $uploadDir . $fileName;
                // $fakeName = uniqid();
                $fake = $uploadDir . $fakeName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats to upload 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = $fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only '.implode('/', $allowTypes).' files are allowed to upload.'; 
                } 
            } 
             
            if($uploadStatus == 1){ 
                // Include the database config file 
                include_once '../../php/conexao.php'; 
                 
                $sql = "INSERT INTO tb_produto (cd_produto, nm_produto,	vl_preco, ds_produto, qtd_produto, ft_produto_principal, id_categoria)
                VALUES (null, '$nomeProduto', '$valorProduto', '$descricaoProduto', '$qtdProduto', '$targetFilePath', '$categoriaProduto')";

                $res = $GLOBALS['mysqli']->query($sql);
                 
                if($insert){ 
                    $response['status'] = 1; 
                    $response['message'] = 'Formulário enviado com sucesso!'; 
                } 
            } 
        
    }else{ 
         $response['message'] = 'Preencha todos os campos.'; 
    } 
} 
 
// Return response 
echo json_encode($response);