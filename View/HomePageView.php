<!-- search file button -->
<div class="upload_file">
    <h1>Upload csv file</h1>
    <form action="index.php" method="POST" enctype="multipart/form-data">
    	<div> <?php if($data){$data;} ?> </div>
        <input id="uploadbtn" accept=".csv" name="file" type="file">

        <!--upload file button -->
        <button id="uploadbtn" type="submit" name="submit" value="submit">Upload</button>
    </form>
</div>
