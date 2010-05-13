    function toggleMenu(id) {
        if(document.getElementById(id).style.display == 'none') {
            document.getElementById(id).style.display = 'block';
            cookie = replaceChars(getCookie('menu'),id,"1");
            setCookie("menu",cookie);
        }else {
            document.getElementById(id).style.display = 'none';
            cookie = replaceChars(getCookie('menu'),id,"0");
            setCookie("menu",cookie);
        }
    }
          
     function InIframe(id) {
         if(top != self) { 
            document.getElementById(id).style.display = 'none';
         } else {
            document.getElementById(id).style.display = 'block';
         }
     }
     
     function replaceChars(cookie,id, what) {
         before = cookie.slice(id, 1);
         id = parseInt(id)+1;
         after = cookie.slice(id, 7);
         return "M" + before + what + after;
     }
     
     function setCookie(name, value) {
         document.cookie = name + "=" + escape(value) + "; expires=Fri, 31 Dec 2010 23:59:59 GMT; path=/; domain=iwex.serveftp.net;";
     }
     
     
     function getCookie(id) {
         var prefix = id + "=";
         var begin = document.cookie.indexOf("; " + prefix);
         if (begin == -1) {
             begin = document.cookie.indexOf(prefix);
             if (begin != 0) {
                 return false;
                 }
             }
         else {
             begin += 2;
             }
         var end = document.cookie.indexOf(";", begin);
         if (end == -1) {
             end = document.cookie.length;
             }
         return unescape(document.cookie.substring(begin + prefix.length, end));
         }
         
    function selfSubmit(formname)
    {
        if(formname){;
              window.document.formname.submit();
            };
    };

	/**
	* marks all rows and selects its first checkbox inside the given element
	* the given element is usaly a table or a div containing the table or tables
	*
	* @param    container    DOM element
	*/
	function markAllRows( container_id ) {
		var rows = document.getElementById(container_id).getElementsByTagName('tr');
		var checkbox;

		for ( var i = 0; i < rows.length; i++ ) {

			checkbox = rows[i].getElementsByTagName( 'input' )[0];

			if ( checkbox && checkbox.type == 'checkbox' ) {
				if ( checkbox.disabled == false ) {
					checkbox.checked = true;
				}
			}
		}

		return true;
	}

	/**
	* marks all rows and selects its first checkbox inside the given element
	* the given element is usaly a table or a div containing the table or tables
	*
	* @param    container    DOM element
	*/
	function unMarkAllRows( container_id ) {
		var rows = document.getElementById(container_id).getElementsByTagName('tr');
		var checkbox;

		for ( var i = 0; i < rows.length; i++ ) {

			checkbox = rows[i].getElementsByTagName( 'input' )[0];

			if ( checkbox && checkbox.type == 'checkbox' ) {
				checkbox.checked = false;
				rows[i].className = rows[i].className.replace(' unmarked', '');
			}
		}

		return true;
	}

	/**
	* marks all rows and selects its first checkbox inside the given element
	* the given element is usaly a table or a div containing the table or tables
	*
	* @param    container    DOM element
	*/
	function inverse_selection( container_id, str_name) {
		var form_details = document.getElementById(container_id);
		var rows = form_details.elements;
		var checkbox;

		for ( var i = 0; i < rows.length; i++ ) {

		  if (rows[i].id == str_name) {
			checkbox = rows[i];

			if ( checkbox && checkbox.type == 'checkbox' ) {
				if (checkbox.checked) {
				  checkbox.checked = false;
				} else {
				  checkbox.checked = true;
				}
			}
		  }
		}

		return true;
	}
/*
	function inverse_selection() {
  for ($i=0; $i < document.qform.elements.length; $i++){
    if ((document.qform.elements[$i].type == "checkbox") && (document.qform.elements[$i].name == "words[]")){
      document.qform.elements[$i].checked = !document.qform.elements[$i].checked;
    }
  }
}
*/