const flashData = $('.flash-data').data('flashdata');

if (flashData) {
  Swal.fire({
    title: 'Selamat Data',
    text: 'Berhasil ' + flashData,
    icon: 'success'
  });
}


//Tombol Hapus
$('.tombol-hapus').on('click', function (e) {
  e.preventDefault();
  const href = $(this).attr('href');
  Swal.fire({
    title: 'Apakah Anda Yakin??',
    text: "Data Akan Dihapus",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = href;
    }
  })
});