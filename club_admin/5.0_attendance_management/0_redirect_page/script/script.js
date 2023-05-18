"use strict";

// (MAIN ATTENDENCE) MAIN CLASS
class MAIN_ATTENDENCE {
  constructor(data) {
    this.data = data;
  }

  // SEND DATA JS--->PHP--->DB
  loadAjax(data, trueHandler, errHandler) {
    var request = new XMLHttpRequest();
    request.open("POST", "includes/includes.0_redirect_page.php", true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );

    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        const output = this.responseText;
        try {
          // console.log(output);
          trueHandler(output);
        } catch (err) {
          errHandler();
        }
      }
    };
    request.send(data);
  }
}

//  (DISPLAY)-->(MAIN_ATTENDENCE) CLASS
class DISPLAY extends MAIN_ATTENDENCE {
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
    data = JSON.parse(data);
    let output = "";
    output += `<table class="table  table-striped">
        <tr>
          <th>Center</th>
          <th>Session</th>
          <th>Day</th>
          <th>Time</th>
          <th></th>
          </tr>
        `;
    for (let i = 0; i < data.length; i++) {
      output += `
        <tr>
        <td>${data[i].center_name}</td>
        <td>${data[i].session_name}</td>
        <td>${data[i].class_day}</td>
        <td>${data[i].class_time}</td>
        <td><button class="btn btn-success" onclick="get_class_get_data(${data[i].class_id})"
        })">✓</button></td>
        <tr>
        `;
    }
    output += `
    </table>`;
    document.getElementById("display").innerHTML = output;
  }

  // (DISPLAY) ERROR HANDLER FUNC
  display_err_handler() {
    document.getElementById(
      "display"
    ).innerHTML = `<div class="alert alert-primary" role="alert">
    No Class 
  </div>`;
  }
}

//CLASS DISPLAY OUTER FUNCTION

const display = function () {
  // GETTING TODAY's DATE
  var now = new Date();
  var days = ["Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun"];
  const today = days[now.getDay() + 3];
  console.log(today);
  let dsp = new DISPLAY("action=display" + "&today=" + today);
  dsp.display_load_data();
};

display();

//  (GET_CLASS)-->(MAIN_ATTENDENCE) CLASS
class GET_CLASS extends MAIN_ATTENDENCE {
  constructor(data) {
    super(data);
  }
  // GET_CLASS LOAD DATA
  get_class_load_data() {
    this.loadAjax(
      this.data,
      this.get_class_true_handler,
      this.get_class_err_handler
    );
  }
  // (GET_CLASS) TRUE HANDLER FUNC
  get_class_true_handler(data) {
    if (data === "ok") {
      location.replace("../1_main_page");
    }
  }
  // (GET_CLASS) ERROR HANDLER FUNC
  get_class_err_handler() {}
}

//CLASS GET_CLASS OUTER FUNCTION
const get_class_get_data = function (data) {
  let g_class = new GET_CLASS("action=get_class" + "&get_class__data=" + data);
  g_class.get_class_load_data();
};
