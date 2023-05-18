// "use strict";
// // (ATTENDANCE_REPORT) MAIN CLASS
// class ATTENDANCE_REPORT {
//   constructor(data) {
//     this.data = data;
//   }

//   // SEND DATA JS--->PHP--->DB
//   loadAjax(data, trueHandler, errHandler) {
//     var request = new XMLHttpRequest();
//     request.open("POST", "includes/includes.5.1_attendance_report.php", true);
//     request.setRequestHeader(
//       "Content-type",
//       "application/x-www-form-urlencoded"
//     );

//     request.onreadystatechange = function () {
//       if (this.readyState === 4 && this.status === 200) {
//         const output = this.responseText;
//         try {
//           trueHandler(output);
//         } catch (err) {
//           console.log(err.message);
//           errHandler();
//         }
//       }
//     };
//     request.send(data);
//   }
// }

// //  (DISPLAY)-->(ATTENDANCE_REPORT) CLASS
// class DISPLAY extends ATTENDANCE_REPORT {
//   constructor(data) {
//     super(data);
//   }
//   // DISPLAY LOAD DATA
//   display_load_data() {
//     this.loadAjax(
//       this.data,
//       this.display_true_handler,
//       this.display_err_handler
//     );
//   }

//   // (DISPLAY) TRUE HANDLER FUNC
//   display_true_handler(data) {
//     console.log(data);
//     data = JSON.parse(data);
//     let output = "";
//     output += `  <table id="example" class="table table-striped" style="width:50%">
//             <thead>
//                 <tr>
//                     <th >No</th>
//                     <th>Date</th>
//                     <th>Day</th>
//                     <th>Time</th>
//                     <th>Center</th>
//                     <th>Session</th>
//                     <th>Name</th>
//                 </tr>
//             </thead>
//             <tbody>`;

//     for (let i = 0; i < data.length; i++) {
//       output += `
//                 <tr>
//                     <td>${i + 1}</td>
//                     <td>${data[i].attendence_date}</td>
//                     <td>${data[i].class_day}</td>
//                     <td>${data[i].class_time}</td>
//                     <td>${data[i].center_name}</td>
//                     <td>${data[i].session_name}</td>
//                     <td>${data[i].student_name}</td>
//                 </tr>`;
//     }
//     output += `

//             </tbody>
//             <tfoot>
//                 <tr>
//                 <th>No</th>
//                     <th>Date</th>
//                     <th>Day</th>
//                     <th>Time</th>
//                     <th>Center</th>
//                     <th>Session</th>
//                     <th>Name</th>
//                 </tr>
//             </tfoot>
//         </table>`;
//     document.getElementById("display").innerHTML = output;
//   }

//   // (DISPLAY) ERROR HANDLER FUNC
//   display_err_handler() {
//     display();
//   }
// }

// //CLASS DISPLAY OUTER FUNCTION
// const display = function () {
//   let dsp = new DISPLAY("action=display");
//   dsp.display_load_data();
// };
// display();
