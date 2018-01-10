/**
 * Helper untuk JavaScript
 * 
 */

KbHelper = {
    isEmpty: function(str) {
    	return (str.length === 0 || !str.trim());
	},
	isEmailValid: function(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    },
    refresh: function() {
        location.reload();
    },
    wrong_email_format_token: function() {
        return "IjDns0e9J2xMRCiQDMSwoknk8f01qMSrkWQUl6muJudOLfy5PN8f6xAgj9zY";
    },
    empty_email_token: function() {
        return "vD2oPjr5qLeJI7DYsvFV5G85KgEnJ2wCOkWd6Gqu0I0wBGB7V4Uo7NQdxCnE";
    },
    empty_password_token: function() {
        return "2oCu5BsoxlBCYf9UpUktKbDJf3ey4vTJdQQjDHaqOeIJpUBdO4e9JZlquqvg";
    },
    failed_login_token: function() {
        return "KbDJf3ey4vTJdQQjDHaqOeIJpUBdO4e9JZlquqvgFqsunx2ZghrVtHTDofG1";
    }
}