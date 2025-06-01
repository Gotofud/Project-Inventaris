$(function () {
  "use strict";

  // Default
  $(".repeater-default").repeater();

  // Custom Show / Hide Configurations
  $(".file-repeater, .email-repeater").repeater({
    show: function () {
      $(this).slideDown();
    },
    hide: function (remove) {
      if (confirm("Are you sure you want to remove this item?")) {
        $(this).slideUp(remove);
      }
    },
  });
});

// var room = 1;
// function education_fields() {
//   room++;

//   const objTo = document.getElementById("education_fields");
//   const divtest = document.createElement("div");
//   divtest.setAttribute("class", "mb-3 removeclass" + room);

//   let options = '<option selected>Select Item</option>';
//   mainData.forEach(data => {
//     options += `<option value="${data.id}">${data.name}</option>`;
//   });

//   divtest.innerHTML =
//     `<div class="row">
//       <div class="col">
//         <div class="input-group">
//           <span class="input-group-text"><i class="ti ti-box"></i></span>
//           <select class="form-select" name="item_id[]">
//             ${options}
//           </select>
//           <input type="number" class="form-control mx-2" name="amount[]" placeholder="Amount">
//           <button class="btn btn-danger" type="button" onclick="remove_education_fields(${room})">
//             <i class="ti ti-minus"></i>
//           </button>
//         </div>
//       </div>
//     </div>`;

//   objTo.appendChild(divtest);
// }

// function remove_education_fields(rid) {
//   $(".removeclass" + rid).remove();
// }
