function deleteData(event){
    event.preventDefault();
    var form = event.target.closest("form");
    //console.log(form);
      swal({
        title: "Chắc chắn xóa?",
        text: "Dữ liệu sau khi xóa sẽ không thể khôi phục. Tiếp tục ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
          if (willDelete) {
            form.submit();
          } else {
            swal("Hủy thành công!");
          }
       });;
}

function deleteImage(event) {
  event.preventDefault();
  var form = event.target.closest("form");
  //console.log(form);
  swal({
      title: "Chắc chắn xóa?",
      text: "Thao tác này sẽ xóa hình ảnh sản phẩm hiện tại",
      icon: "warning",
      buttons: true,
      dangerMode: true,
  }).then((willDelete) => {
      if (willDelete) {
          form.submit();
      } else {
          swal("Hủy thành công!");
      }
  });;
}