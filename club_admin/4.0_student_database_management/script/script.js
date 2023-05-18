"use strict";

// (STUDENT DATABASE MANAGEMENT) MAIN CLASS
class STUDENT_DATABASE_MANAGEMENT {
  constructor(data) {
    this.data = data;
  }

  // SEND DATA JS--->PHP--->DB
  loadAjax(data, trueHandler, errHandler) {
    var request = new XMLHttpRequest();
    request.open(
      "POST",
      "includes/includes.4.0_student_database_management.php",
      true
    );
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    request.setRequestHeader("Content-Type", "multipart/form-data");

    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        const output = this.responseText;
        try {
          trueHandler(output);
        } catch (err) {
          errHandler();
        }
      }
    };
    request.send(data);
  }
}

//  (DISPLAY)-->(STUDENT DATABASE MANAGEMENT) CLASS
class DISPLAY extends STUDENT_DATABASE_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // DISPLAY LOAD DATA
  display_load_data() {
    this.loadAjax(
      this.data,
      this.display_true_handler,
      this.display_err_handler
    );
  }

  // (DISPLAY) TRUE HANDLER FUNC
  display_true_handler(data) {
    display_table(data);
  }

  // (DISPLAY) ERROR HANDLER FUNC
  display_err_handler() {
    display();
  }
}

//CLASS DISPLAY OUTER FUNCTION
const display = function () {
  let dsp = new DISPLAY("action=display");
  dsp.display_load_data();
};

display();

//  (search)-->(STUDENT_DATABASE_MANAGEMENT) CLASS
class SEARCH extends STUDENT_DATABASE_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // SEARCH LOAD DATA
  search_load_data() {
    this.loadAjax(this.data, this.search_true_handler, this.search_err_handler);
  }
  // (SEARCH) TRUE HANDLER FUNC
  search_true_handler(data) {
    display_table(data);
  }

  // (SEARCH) ERROR HANDLER FUNC
  search_err_handler() {
    let output = "";
    output += `<div class="alert alert-warning" role="alert">
      Cannot find vendor name
    </div>`;

    document.getElementById("display").innerHTML = output;
  }
}

//CLASS SEARCH OUTER FUNC
const search_get_id = function () {
  const data = document.getElementById("search").value;

  console.log(data);

  if (data.length === 0) display();
  if (data.length !== 0) {
    let sch = new SEARCH("action=search" + "&search_data=" + data);
    sch.search_load_data();
  }
};

//  (INSERT)-->(STUDENT_DATABASE_MANAGEMENT) CLASS
class INSERT extends STUDENT_DATABASE_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // INSERT LOAD DATA
  insert_load_data() {
    this.loadAjax(this.data, this.insert_true_handler, this.insert_err_handler);
  }
  // (INSERT) TRUE HANDLER FUNC
  insert_true_handler(data) {
    if (data === "ok") {
      clear_modal_data();
      document.getElementById("close").click();
      alert("New student record Successfully Inserted!");
      display();
    }
  }
  // (INSERT) ERROR HANDLER FUNC
  insert_err_handler() {}
}

//CLASS INSERT OUTER FUNCTION
const insert_get_id = function (data) {
  return document.getElementById(data).value;
};

const insert_get_data = function () {
  const student_name = insert_get_id("student_name");
  const student_ic = insert_get_id("student_ic");
  const student_grade = insert_get_id("student_grade");
  const student_center_id = insert_get_id("student_center_id");
  const student_address = insert_get_id("student_address");
  const student_tel_no = insert_get_id("student_tel_no");
  const student_email = insert_get_id("student_email");
  insert_check_empty(
    student_name,
    student_ic,
    student_grade,
    student_center_id,
    student_address,
    student_tel_no,
    student_email
  );
};
const insert_check_empty = function (
  student_name,
  student_ic,
  student_grade,
  student_center_id,
  student_address,
  student_tel_no,
  student_email
) {
  if (
    student_name.length === 0 ||
    student_ic.length === 0 ||
    student_grade.length === 0 ||
    student_center_id.length === 0 ||
    student_address.length === 0 ||
    student_tel_no.length === 0 ||
    student_email.length === 0
  ) {
    alert("input cannot be empty");
  }

  if (
    student_name.length !== 0 &&
    student_ic.length !== 0 &&
    student_grade.length !== 0 &&
    student_center_id.length !== 0 &&
    student_address.length !== 0 &&
    student_tel_no.length !== 0 &&
    student_email.length !== 0
  ) {
    insert_assign_class(
      student_name,
      student_ic,
      student_grade,
      student_center_id,
      student_address,
      student_tel_no,
      student_email
    );
  }
};

const insert_assign_class = function (
  student_name,
  student_ic,
  student_grade,
  student_center_id,
  student_address,
  student_tel_no,
  student_email
) {
  let ins = new INSERT(
    "action=insert" +
      "&student_name=" +
      student_name +
      "&student_ic=" +
      student_ic +
      "&student_grade=" +
      student_grade +
      "&student_center_id=" +
      student_center_id +
      "&student_address=" +
      student_address +
      "&student_tel_no=" +
      student_tel_no +
      "&student_email=" +
      student_email
  );
  ins.insert_load_data();
};

//  (FETCH_EDIT)-->(STUDENT_DATABASE_MANAGEMENT) CLASS
class FETCH_EDIT extends STUDENT_DATABASE_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // FETCH_EDIT LOAD DATA
  fetch_edit_load_data() {
    this.loadAjax(
      this.data,
      this.fetch_edit_true_handler,
      this.fetch_edit_err_handler
    );
  }
  // (FETCH_EDIT) TRUE HANDLER FUNC
  fetch_edit_true_handler(data) {
    console.log(data);
    let output = "";
    data = JSON.parse(data);
    for (let i = 0; i < data.length; i++) {
      // SETTING THE VALUE TO INPUT FORM
      document.getElementById("student_id").value = data[i].student_id;
      document.getElementById("student_name").value = data[i].student_name;
      document.getElementById("student_ic").value = data[i].student_ic;
      document.getElementById("student_grade").value = data[i].student_grade;
      document.getElementById("student_center_id").value =
        data[i].student_center_id;
      document.getElementById("student_address").value =
        data[i].student_address;
      document.getElementById("student_tel_no").value = data[i].student_tel_no;
      document.getElementById("student_email").value = data[i].student_email;
      // END OF SETTING VALUE TO THE INPUT FORM

      // SETTING THE QR CODE
      document.getElementById("student_card").style.display = "block";

      document.getElementById(
        "title"
      ).innerHTML = `<b>ENERGIZING WELLNESS TAEKWONDO</b>`;
      new QRCode(document.getElementById("qrcode"), data[i].student_id);

      // var qrcode = new QRCode("qrcode", {
      //   text: data[i].student_id,
      //   width: 50,
      //   height: 50,
      //   colorDark: "#000000",
      //   colorLight: "#ffffff",
      //   correctLevel: QRCode.CorrectLevel.H,
      // });
      output += `<ul class="list-group list-group-flush">`;
      output += `<li class="list-group-item">ID : ${data[i].student_id}</li>`;
      output += `<li class="list-group-item">NAME : ${data[i].student_name}</li>`;
      output += `<li class="list-group-item">CENTER : ${data[i].center_name}</li>`;
      output += ` </ul>`;
      document.getElementById("list").innerHTML = output;
      // END OF SETTING THE QR CODE

      document.getElementById("open").click();
      show_edit_modal_btn();
    }
  }
  // (FETCH_EDIT) ERROR HANDLER FUNC
  fetch_edit_err_handler() {}
}

//CLASS FETCH_EDIT OUTER FUNCTION
const fetch_edit_get_data = function (data) {
  let f_edit = new FETCH_EDIT("action=fetch_edit" + "&fetch_edit_data=" + data);
  f_edit.fetch_edit_load_data();
};

//  (EDIT)-->(STUDENT_DATABASE_MANAGEMENT) CLASS
class EDIT extends STUDENT_DATABASE_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // EDIT LOAD DATA
  loadData() {
    this.loadAjax(this.data, this.edit_trueHandler, this.edit_errHandler);
  }

  // (EDIT) TRUE HANDLER FUNC
  edit_trueHandler(data) {
    alert(data);
    if (data === "ok") {
      clear_modal_data();
      document.getElementById("close").click();
      alert("Data Successfully Updated!");
      display();
    }
  }
  // (EDIT) ERROR HANDLER FUNC
  edit_errHandler() {}
}

//CLASS EDIT OUTER FUNCTION
const edit_get_id = function (data) {
  return document.getElementById(data).value;
};

const edit_get_data = function () {
  const student_id = edit_get_id("student_id");
  const student_name = edit_get_id("student_name");
  const student_ic = edit_get_id("student_ic");
  const student_grade = edit_get_id("student_grade");
  const student_center_id = edit_get_id("student_center_id");
  const student_address = edit_get_id("student_address");
  const student_tel_no = edit_get_id("student_tel_no");
  const student_email = edit_get_id("student_email");

  edit_check_empty(
    student_id,
    student_name,
    student_ic,
    student_grade,
    student_center_id,
    student_address,
    student_tel_no,
    student_email
  );
};

const edit_check_empty = function (
  student_id,
  student_name,
  student_ic,
  student_grade,
  student_center_id,
  student_address,
  student_tel_no,
  student_email
) {
  if (
    student_id.length === 0 ||
    student_name.length === 0 ||
    student_ic.length === 0 ||
    student_grade.length === 0 ||
    student_center_id.length === 0 ||
    student_address.length === 0 ||
    student_tel_no.length === 0 ||
    student_email.length === 0
  ) {
    alert("input cannot be empty");
  }

  if (
    student_id.length !== 0 &&
    student_name.length !== 0 &&
    student_ic.length !== 0 &&
    student_grade.length !== 0 &&
    student_center_id.length !== 0 &&
    student_address.length !== 0 &&
    student_tel_no.length !== 0 &&
    student_email.length !== 0
  ) {
    edit_assign_class(
      student_id,
      student_name,
      student_ic,
      student_grade,
      student_center_id,
      student_address,
      student_tel_no,
      student_email
    );
  }
};

const edit_assign_class = function (
  student_id,
  student_name,
  student_ic,
  student_grade,
  student_center_id,
  student_address,
  student_tel_no,
  student_email
) {
  let edit = new EDIT(
    "action=edit" +
      "&student_id=" +
      student_id +
      "&student_name=" +
      student_name +
      "&student_ic=" +
      student_ic +
      "&student_grade=" +
      student_grade +
      "&student_center_id=" +
      student_center_id +
      "&student_address=" +
      student_address +
      "&student_tel_no=" +
      student_tel_no +
      "&student_email=" +
      student_email
  );
  edit.loadData();
};

// ----------------------------------END OF CLASSES------------------------------------------

// DISPLAY STUDENT TABLE
const display_table = function (data) {
  data = JSON.parse(data);
  let output = "";
  output += `<table class="table  table-striped">
      <tr>
      <th>#</th>
        <th>Name</th>
        <th>IC</th>
        <th>Center</th>
        <th>Grade</th>
        <th>Address</th>
        <th>Tel-No</th>
        <th>Email</th>
        <th></th>
        </tr>
      `;
  for (let i = 0; i < data.length; i++) {
    output += `
      <tr>
      <td>${i + 1}</td>
      <td>${data[i].student_name}</td>
      <td>${data[i].student_ic}</td>
      <td>${data[i].center_name}</td>
      <td>${data[i].student_grade}</td>
      <td>${data[i].student_address}</td>
      <td>${data[i].student_tel_no}</td>
      <td>${data[i].student_email}</td>
      <td><button class="btn btn-warning" onclick="fetch_edit_get_data(${
        data[i].student_id
      })"
      })">Edit</button></td>
      <tr>
      `;
  }
  output += `
  </table>`;
  document.getElementById("display").innerHTML = output;
};

// CLEAR MODAL DATA
const clear_modal_data = function () {
  document.getElementById("student_id").value = "";
  document.getElementById("student_name").value = "";
  document.getElementById("student_ic").value = "";
  document.getElementById("student_grade").value = "";
  document.getElementById("student_center_id").value = "";
  document.getElementById("student_address").value = "";
  document.getElementById("student_tel_no").value = "";
  document.getElementById("student_email").value = "";

  // THE QR SETTING
  document.getElementById("qrcode").innerHTML = "";
  document.getElementById("student_card").style.display = "none";
};

// SHOW CREATE MODAL BTN
const show_create_modal_btn = function () {
  var show_create = document.getElementById("btn_create");
  var hide_edit = document.getElementById("btn_edit");
  show_create.style.display = "block";
  hide_edit.style.display = "none";
};

// SHOW EDIT MODAL BTN
const show_edit_modal_btn = function () {
  var show_edit = document.getElementById("btn_edit");
  var hide_create = document.getElementById("btn_create");
  show_edit.style.display = "block";
  hide_create.style.display = "none";
};

function generatePDF() {
  var name = document.getElementById("student_name").value;

  var element = document.getElementById("execute");
  var opt = {
    margin: 1,
    filename: `${name}.pdf`,
    image: { type: "jpeg", quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
  };

  // New Promise-based usage:
  html2pdf().set(opt).from(element).save();
}
