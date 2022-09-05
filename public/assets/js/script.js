$(document).on('click', '#btn-edit', function() {
	$('.modal-body #id_admin').val($(this).data('id'));
	$('.modal-body #data-username').val($(this).data('username'));
	$('.modal-body #data-admin_nama').val($(this).data('admin_nama'));
	$('.modal-body #data-admin_no_hp').val($(this).data('admin_no_hp'));
	$('.modal-body #data-admin_email').val($(this).data('admin_email'));

})



    const swal = $('.swal').data('swal');
    // alert('tesssku');
    if (swal) {
      Swal.fire({
        title: 'Success',
        text: swal,
        icon:'success'

      })
    }



$(document).on('click', '.btn-hapus', function (e){
	e.preventDefault();
	const href = $(this).attr('href');
	// alert("ini link ="+href);

	 Swal.fire({
        title: 'Apakah Anda yakin ?',
        text: "Data yang telah dihapus tidak bisa dikembalikan !",
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
      }). then((result) => {
      	if(result.value){
      		document.location.href = href;

      	}
      })
})
