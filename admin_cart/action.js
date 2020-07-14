let content = $("#grid-body");

function load_Data() {
  $.ajax({
    url: "./validar",
    type: "POST",
    dataType: "json",
    Async: false,
    data: {
      pedidos: 1,
    },
    beforeSend: function () {
      content.html(`<tr align="center">
					<td align="center">
						<img class="loading-gif" width="40" src="../img/loading.gif"/>
					</td>
				</tr>`);
    },
  })
    .done(function (response) {
      const { data, status } = response;
      if (status) {
        content.html("");
        $.each(data, function (index, item) {
          let element = `
					<tr>
						<td class="details-control">
							<i data-id="${item.id}" class="fas fa-angle-right"></i>
						</td>
						<td> ${index + 1} </td>
						<td> ${item.ndoc} </td>
						<td> ${item.fecha} </td>
						<td> ${item.nombre} </td>
						<td> ${item.direccion} </td>
						<td> ${item.telefono} </td>
						<td> ${item.email} </td>
						<td> online </td>
						<td> <span class="badge badge-warning py-1 px-2"> pendiente </span> </td>
						<td>
							<div class="dropdown text-center">
								<button class="btn-round btn-primary " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-ellipsis-v"></i>
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="#"> pagado </a>
									<a class="dropdown-item" href="#"> pendiente </a>									
								</div>
							</div>
						</td>
					</tr>
				`;
          content.append(element);
        });
        let table = $("#table").DataTable();
        $("#table tbody").on("click", "td.details-control", function () {
          var tr = $(this).parents("tr");
          var row = table.row(tr);
          if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass("shown");
          } else {
            let element = detail_items(row.data());
            row.child(element).show();
            tr.addClass("shown");
          }
        });
      }
    })
    .fail(function () {
      console.log("error");
    });
}

function stringToHTML(str, type = false) {
  const html = document.implementation.createHTMLDocument();
  if (!type) {
    html.body.innerHTML = str[0];
    let element = html.body.children[0];
    return element.dataset.id;
  } else {
    html.body.innerHTML = str;
    let element = html.body.children[0];
    return element;
  }
}

function detail_content(item) {
  return `<tr>
            <td> ${item.descripcion} </td>
            <td> ${item.cantidad} </td>
            <td> ${item.precio} </td>
            <td> ${item.importe} </td>
        </tr>`;
}

function detail_items(d) {
  let id = stringToHTML(d);
  let element = "";

  $.ajax({
    url: "./validar",
    type: "POST",
    async: false,
    dataType: "json",
    data: {
      detail: 1,
      id: id,
    },
  }).done(function (response) {
    const { data, status } = response;
    if (status) {
      $.each(data, function (index, item) {
        element += detail_content(item);
      });
    }
    if (!status) {
      element += `<tr> <td> Hubo error al cargar </td> </tr>`;
    }
  });
  let _row = `<table class="table table-sm">
			  <thead>
				  <th> Producto </th>
				  <th> Cantidad </th>
				  <th> Precio </th>
				  <th> Importe </th>
			  </thead>
			  <tbody> `;
  _row += element;
  _row += `</tbody>
		  </table>`;
  console.log(stringToHTML(_row, true));
  return stringToHTML(_row, true);
}
jQuery(document).ready(function ($) {
  Producto();
  if (content.length) {
    load_Data();
  }
  $("body").delegate(".modal ", "click", function (event) {
    Modal();
  });
  $("body").delegate(".addProd ", "click", function (event) {
    event.preventDefault();
    $.ajax({
      url: "validar.php",
      method: "POST",
      data: {
        newPro: 1,
      },
      beforeSend: function () {
        $(".contenedor-item").html(
          '<img class="loading-gif" src="../img/loading.gif">'
        );
      },
    }).done(function (data) {
      setTimeout(function () {
        $(".contenedor-item").html(data);
      }, 500);
    });
  });
  /*add new product menu*/
  $("body").delegate(".addproduct ", "click", function (event) {
    event.preventDefault();
    $.ajax({
      url: "validar.php",
      method: "POST",
      data: {
        newPro: 1,
      },
      beforeSend: function () {
        $(".contenedor-item").html(
          '<img class="loading-gif" src="../img/loading.gif">'
        );
      },
    }).done(function (data) {
      setTimeout(function () {
        $(".contenedor-item").html(data);
      }, 500);
    });
  });
  /*save product*/
  $("body").delegate("#new_product", "submit", function (e) {
    e.preventDefault();
    var form = new FormData($(this)[0]);
    $.ajax({
      url: "RegisterProducto.php",
      method: "POST",
      processData: false,
      contentType: false,
      data: form,
      beforeSend: function () {
        $(".contenedor-item").html(
          '<img class="loading-gif" src="../img/loading.gif">'
        );
      },
    }).done(function (data) {
      $(".sms").html(data);
      if (data == "registro con exito") {
        Producto();
      }
    });
  });
  /*	 select list  page	*/
  $("body").delegate(".numpage ", "click", function (event) {
    event.preventDefault();
    var valor = $(this).attr("href");
    $.ajax({
      url: "validar.php",
      method: "POST",
      data: {
        product: 1,
        idnext: valor,
      },
    }).done(function (data) {
      setTimeout(function () {
        $(".contenedor-item").html(data);
      }, 300);
    });
  });
  $("#login_form").submit(function (event) {
    event.preventDefault();
    var usu = $(this).find("#user").val();
    var pwd = $(this).find("#pwd").val();
    console.log(usu);
    console.log(pwd);
    $.ajax({
      url: "validar.php",
      method: "POST",
      data: {
        log_a: 1,
        user: usu,
        pass: pwd,
      },
    }).done(function (data) {
      $(".smslog").html(data);
    });
  });
});

function Producto() {
  $.ajax({
    url: "validar.php",
    method: "POST",
    data: {
      product: 1,
    },
    beforeSend: function () {
      $(".contenedor-item").html(
        '<img class="loading-gif" src="../img/loading.gif">'
      );
    },
  }).done(function (data) {
    setTimeout(function () {
      $(".contenedor-item").html(data);
    }, 300);
  });
}
var valor = 0;

function Modal() {
  if (valor == 0) {
    $(".modal").toggleClass("Mactive");
    setTimeout(function () {
      /*$('.conte-modal').toggleClass('cmActive');*/
      $(".conte-modal").animate(
        {
          height: "70vh",
        },
        300
      );
    }, 400);
    valor = 1;
  } else {
    $(".modal").toggleClass("Mactive");
    setTimeout(function () {
      /*$('.conte-modal').toggleClass('cmActive');*/
      $(".conte-modal").animate(
        {
          height: "0vh",
        },
        300
      );
    }, 400);
    valor = 0;
  }
}
