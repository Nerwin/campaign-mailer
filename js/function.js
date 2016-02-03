$(function () {
	$("#createContact").click(function () {
		/* VALUES */
		var nom = $("#name").val();
		var mail = $("#mail").val();
		var listId = $("#listId").val();

		/* DATASTRING */
		var dataString = 'nom=' + nom + '&mail=' + mail + '&listId=' + listId;
		$("#contacts").append("Name:" + nom + " - " + mail);
	})
});