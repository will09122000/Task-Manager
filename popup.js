function get_ids() {
    var info = document.getElementsByTagName("td");
    var input = Array.prototype.slice.call(document.getElementsByTagName("input"));
    input = input.splice(3, input.length);
    var id = [];
    var checked = [];
    var task_id = [];

    for (let i=0; i < info.length; i++)
        if (info[i].hasAttribute("name")) {
            id.push(info[i].innerHTML);
        }

    for (let i=0; i < input.length; i++) {
        if (input[i].type == "checkbox" && input[i].checked == true) {
            checked.push(true);
        } else {
            checked.push(false);
        }
    }

    for (let i=0; i < checked.length; i++) {
        if (checked[i]) {
            task_id.push(id[i]);
        }
    }
    task_id = task_id.toString();

    return task_id;
}

function pop_up_import() {
    var confirmed = false;

    if (confirm("Are you sure you would like to import these tasks?")) {
        confirmed = true;
        document.getElementById("ids").value = get_ids();
    }
    return confirmed;
}



function pop_up_export() {

    var name = document.getElementById("title");
    var description = document.getElementById("description");
    var due = document.getElementById("due_date");
    var confirmed = false;

    if (confirm("Are you sure you would like to export this task? \n Name: " + name.value + "\n Description: " + description.value + "\n Due: "  + due.value))
        confirmed = true;

    return confirmed;
}