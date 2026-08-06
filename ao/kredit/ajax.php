<script>
    $("#simpan").click(function(){
        if(!$("form")[0].checkValidity()){
            $("form")[0].reportValidity();
            return false;
        }

        $.ajax({
            url:"proses_create.php",
            type:"POST",
            data:$("form").serialize(),
            success:function(response){
                if(response=="success"){
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "Data berhasil disimpan",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    setTimeout(function(){
                        window.location="index.php";
                    }, 1500);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response
                    });
                }
            },
            error:function(xhr,status,error){
                alert("Terjadi kesalahan AJAX : "+ error);
            }
        });
    });

    $("#update").click(function(){
        if(!$("#editForm")[0].checkValidity()){
            $("#editForm")[0].reportValidity();
            return false;
        }
        
        $.ajax({
            url:"proses_update.php",
            type:"POST",
            data:$("#editForm").serialize(),
            success:function(response){
                if(response=="success"){
                    Swal.fire({
                        title: "Berhasil!",
                        text: "Data berhasil diupdate",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    setTimeout(function(){
                        window.location="index.php";
                    }, 1500);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response
                    });
                }
            },
            error:function(xhr,status,error){
                alert("Terjadi kesalahan AJAX : "+ error);
            }
        });
    });

    $("#approve").click(function(){
        if(!$("#approveForm")[0].checkValidity()){
            $("#approveForm")[0].reportValidity();
            return false;
        }
        
        $.ajax({
            url:"proses_approve.php",
            type:"POST",
            data:$("#approveForm").serialize(),
            success:function(response){
                if(response=="success"){
                    Swal.fire({
                        title: "Berhasil!",
                        text: "Update berhasil disetujui",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    setTimeout(function(){
                        window.location="approval.php";
                    }, 1500);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response
                    });
                }
            },
            error:function(xhr,status,error){
                alert("Terjadi kesalahan AJAX : "+ error);
            }
        });
    });

    $(document).ready(function(){
        function fieldAgunan(select){
            let jenis = select.val();
            let html = "";

            if(jenis=="shm" || jenis=="shgb" || jenis=="shmsrs"){
                html = `
                <div class="row">
                    <div class="col-md-4">
                        <label>No. Agunan :</label>
                        <input 
                        type="text"
                        name="nomor_agunan[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label>Nama Pemilik :</label>
                        <input 
                        type="text"
                        name="nama_pemilik[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label>Alamat :</label>
                        <input 
                        type="text"
                        name="alamat_agunan[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                    <div class="col-md-3 d-none">
                        <label>Nama Agunan :</label>
                        <input 
                        type="text"
                        name="nama_agunan[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                </div>
                `;
            }else if(jenis=="bpkb" || jenis=="invoice" || jenis=="deposito"){
                html = `
                <div class="row">
                    <div class="col-md-6">
                        <label>No. Agunan :</label>
                        <input 
                        type="text"
                        name="nomor_agunan[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label>Nama Pemilik :</label>
                        <input 
                        type="text"
                        name="nama_pemilik[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                    <div class="col-md-3 d-none">
                        <label>Nama Agunan :</label>
                        <input 
                        type="text"
                        name="nama_agunan[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                    <div class="col-md-3 d-none">
                        <label>Alamat :</label>
                        <input 
                        type="text"
                        name="alamat_agunan[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                </div>
                `;
            }else if(jenis=="lainnya"){
                html = `
                <div class="row">
                    <div class="col-md-3">
                        <label>Nama Agunan :</label>
                        <input 
                        type="text"
                        name="nama_agunan[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label>No. Agunan :</label>
                        <input 
                        type="text"
                        name="nomor_agunan[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label>Nama Pemilik :</label>
                        <input 
                        type="text"
                        name="nama_pemilik[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label>Alamat :</label>
                        <input 
                        type="text"
                        name="alamat_agunan[]"
                        class="form-control"
                        autocomplete="off">
                    </div>
                </div>
                `;
            }
            select.closest(".agunan-item")
            .find(".field-agunan")
            .html(html);
        }
        $(document).on("change",".jenis-agunan",function(){
            fieldAgunan($(this));
        });

        $("#add-agunan").click(function(){
            if($(".agunan-item").length >= 10){
                Swal.fire("Peringatan","Maksimal 10 agunan","warning");
                return;
            }
            let html = `
            <div class="row mb-3 agunan-item">
                <div class="col-md-2">
                    <label>Jenis Agunan :</label>
                    <select 
                    name="jenis_agunan[]" 
                    class="form-control jenis-agunan">
                        <option value="">Pilih Agunan</option>
                        <option value="shm">SHM</option>
                        <option value="shgb">SHGB</option>
                        <option value="shmsrs">SHMSRS</option>
                        <option value="bpkb">BPKB</option>
                        <option value="invoice">INVOICE</option>
                        <option value="deposito">Deposito</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="col-md-9 field-agunan"></div>
                <div class="col-md-1 mt-4">
                    <div class="float-end">
                        <button 
                        type="button" 
                        class="btn btn-danger remove"
                        title="Hapus Agunan">
                        <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            `;
            $("#list-agunan").append(html);
        });

        $(document).on("click",".remove",function(){
            if($(".agunan-item").length <= 1){
                Swal.fire("Peringatan","Minimal 1 agunan","warning");
                return;
            }
            $(this)
            .closest(".agunan-item")
            .remove();
        });
    });
</script>