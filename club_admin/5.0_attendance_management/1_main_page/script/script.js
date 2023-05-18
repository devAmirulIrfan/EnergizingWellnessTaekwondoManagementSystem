"use strict";

// (ATTENDENCE MANAGEMENT) MAIN CLASS
class ATTENDENCE_MANAGEMENT {
  constructor(data) {
    this.data = data;
  }

  // SEND DATA JS--->PHP--->DB
  loadAjax(data, trueHandler, errHandler) {
    var request = new XMLHttpRequest();
    request.open("POST", "includes/includes.1_main_page.php", true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );

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

//  (SEARCH)-->(ATTENDENCE_MANAGEMENT) CLASS
class SEARCH extends ATTENDENCE_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // SEARCH LOAD DATA
  search_load_data() {
    this.loadAjax(this.data, this.search_true_handler, this.search_err_handler);
  }
  // (SEARCH) TRUE HANDLER FUNC
  search_true_handler(data) {
    data = JSON.parse(data);

    console.log(data);
    let output = "";
    for (let i = 0; i < data.length; i++) {
      output += `
      <div class="d-grid gap-2" style="margin-top: 0.2rem">
      <button type="button" class="btn btn-light" onclick="insert_get_data(${data[i].student_id})">${data[i].student_name}(${data[i].center_name})</button>
      </div>
        `;
    }
    document.getElementById("display").innerHTML = output;
  }
  // (SEARCH) ERROR HANDLER FUNC
  search_err_handler() {
    let output = "";
    output += `
    <div class="alert alert-warning" role="alert">
      Cannot find student name
    </div>`;

    document.getElementById("display").innerHTML = output;
  }
}

//CLASS SEARCH OUTER FUNC
const search_get_id = function () {
  const data = document.getElementById("search").value;

  console.log(data);

  if (data.length === 0) document.getElementById("display").innerHTML = "";
  if (data.length !== 0) {
    let sch = new SEARCH("action=search" + "&search_data=" + data);
    sch.search_load_data();
  }
};

//  (INSERT)-->(ATTENDENCE MANAGEMENT) CLASS
class INSERT extends ATTENDENCE_MANAGEMENT {
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
      display_attendence();
    }
    document.getElementById("search").value = "";
    document.getElementById("display").innerHTML = "";
  }
  // (INSERT) ERROR HANDLER FUNC
  insert_err_handler() {}
}

//CLASS INSERT OUTER FUNCTION

const insert_get_data = function (data) {
  let ins = new INSERT("action=insert" + "&student_id=" + data);
  ins.insert_load_data();
};

//  (DISPLAY_CLASS_TITLE)-->(ATTENDENCE MANAGEMENT) CLASS
class DISPLAY_CLASS_TITLE extends ATTENDENCE_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // DISPLAY_CLASS_TITLE LOAD DATA
  display_class_title_load_data() {
    this.loadAjax(
      this.data,
      this.display_class_title_true_handler,
      this.display_class_title_err_handler
    );
  }

  // (DISPLAY_CLASS_TITLE) TRUE HANDLER FUNC
  display_class_title_true_handler(data) {
    data = JSON.parse(data);
    const date = new Date();
    let output = "";
    for (let i = 0; i < data.length; i++) {
      output += `<div class="alert alert-info" role="alert">
     Date :${date} <br> Day :${data[i].class_day} / Center :${data[i].center_name} / Session :${data[i].session_name}
    </div>
        `;
    }
    output += `
    </table>`;
    document.getElementById("class_title").innerHTML = output;
  }

  // (DISPLAY_CLASS_TITLE) ERROR HANDLER FUNC
  display_class_title_err_handler() {
    // display();
  }
}

//CLASS DISPLAY_CLASS_TITLE OUTER FUNCTION
const display_class_title = function () {
  let dsp_class_title = new DISPLAY_CLASS_TITLE("action=display_class_title");
  dsp_class_title.display_class_title_load_data();
};

display_class_title();

//  (DISPLAY_ATTENDENCE)-->(ATTENDENCE MANAGEMENT) CLASS
class DISPLAY_ATTENDENCE extends ATTENDENCE_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // DISPLAY LOAD DATA
  display_attendence_load_data() {
    this.loadAjax(
      this.data,
      this.display_attendence_true_handler,
      this.display_attendence_err_handler
    );
  }

  // (DISPLAY ATTENDANCE) TRUE HANDLER FUNC
  display_attendence_true_handler(data) {
    data = JSON.parse(data);
    let output = "";
    output += `<table class="table  table-striped">
        <tr>
        <th>No</th>
          <th>Student Name</th>
          <th></th>
          </tr>
        `;
    for (let i = 0; i < data.length; i++) {
      output += `
        <tr>
        <td>${i + 1}</td>
        <td>${data[i].student_name}</td>
        <td><button class="btn btn-danger" onclick="delete_attendence_get_data(${
          data[i].student_id
        })"
        })">X</button></td>
        <tr>
        `;
    }
    output += `
    </table>`;
    document.getElementById("display_attendence").innerHTML = output;
  }

  // (DISPLAY) ERROR HANDLER FUNC
  display_attendence_err_handler() {
    document.getElementById(
      "display_attendence"
    ).innerHTML = `<div class="alert alert-warning" role="alert">
     Attendance is empty
  </div>`;
  }
}

//CLASS DISPLAY OUTER FUNCTION
const display_attendence = function () {
  let dsp_attendence = new DISPLAY_ATTENDENCE("action=display_attendence");
  dsp_attendence.display_attendence_load_data();
};

display_attendence();

//  (DELETE_ATTENDENCE)-->(ORDER MANAGEMENT) CLASS
class DELETE_ATTENDENCE extends ATTENDENCE_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // DELETE LOAD DATA
  delete_attendence_load_data() {
    this.loadAjax(
      this.data,
      this.delete_attendence_true_handler,
      this.delete_attendence_err_handler
    );
  }
  // (DELETE ATTENDENCE) TRUE HANDLER FUNC
  delete_attendence_true_handler(data) {
    if (data === "ok") {
      display_attendence();
    }
  }
  // (DELETE ATTENDENCE) ERROR HANDLER FUNC
  delete_attendence_err_handler() {}
}

//CLASS DELETE ATTENDENCE OUTER FUNCTION
const delete_attendence_get_data = function (data) {
  let del = new DELETE_ATTENDENCE(
    "action=delete_attendence" + "&delete_data=" + data
  );
  del.delete_attendence_load_data();
};

//-------------------------------------END OF FUNCTION -------------------------------
