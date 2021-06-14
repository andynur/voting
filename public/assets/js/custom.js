$(function() {
  $('.table-datatable').DataTable( {
    responsive: true,
    "scrollX": true
  });
  $(document).on('click', '.delete-button', function (e) {
    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Data tidak bisa dikembalikan lagi setelahnya!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        reverseButtons: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: $(this).data('route'),
          type: 'DELETE',
          dataType: "JSON",
          data: {
            "_method": 'DELETE',
            "_token": $('meta[name="csrf-token"]').attr('content'),
          },
          success: function (val) {
            Swal.fire(
                'Sukses!',
                'Data berhasil dihapus',
                'success'
            )
            location.reload();
          },
          error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire(
                'Gagal!',
                xhr.responseJSON.message || "Data Gagal Dihapus",
                'error'
            )
            console.log(xhr.responseText, ajaxOptions, thrownError)
          }
        })
      }
    })
  })
})