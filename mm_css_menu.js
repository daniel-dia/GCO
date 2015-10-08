var mmOpenContainer = null;
var mmOpenMenus = null;
var mmHideMenuTimer = null;

function MM_menuStartTimeout(hideTimeout) {
	mmHideMenuTimer = setTimeout("MM_menuHideMenus()", hideTimeout);	
}

function MM_menuHideMenus() {
	MM_menuResetTimeout();
	if(mmOpenContainer) {
		var c = document.getElementById(mmOpenContainer);
		c.style.visibility = "inherit";
		mmOpenContainer = null;
	}
	if( mmOpenMenus ) {
		for(var i in mmOpenMenus) {
			var m = document.getElementById(mmOpenMenus[i]);
			m.style.visibility = "hidden";			
		}
		mmOpenMenus = null;
	}
}

function MM_menuHideSubmenus(menuName) {
	if( mmOpenMenus ) {
		var h = false;
		var c = 0;
		for(var i in mmOpenMenus) {
			if( h ) {
				var m = document.getElementById(mmOpenMenus[i]);
				m.style.visibility = "hidden";
			} else if( mmOpenMenus[i] == menuName ) {
				h = true;
			} else {
				c++;
			}
		}
		mmOpenMenus.length = c+1;
	}
}

function MM_menuOverMenuItem(menuName, subMenuSuffix) {
	MM_menuResetTimeout();
	MM_menuHideSubmenus(menuName);
	if( subMenuSuffix ) {
		var subMenuName = "" + menuName + "_" + subMenuSuffix;
		MM_menuShowSubMenu(subMenuName);
	}
}

function MM_menuShowSubMenu(subMenuName) {
	MM_menuResetTimeout();
	var e = document.getElementById(subMenuName);
	e.style.visibility = "inherit";
	if( !mmOpenMenus ) {
		mmOpenMenus = new Array;
	}
	mmOpenMenus[mmOpenMenus.length] = "" + subMenuName;
}

function MM_menuResetTimeout() {
	if (mmHideMenuTimer) clearTimeout(mmHideMenuTimer);
	mmHideMenuTimer = null;
}

function MM_menuShowMenu(containName, menuName, xOffset, yOffset, triggerName) {
	MM_menuHideMenus();
	MM_menuResetTimeout();
	MM_menuShowMenuContainer(containName, xOffset, yOffset, triggerName);
	MM_menuShowSubMenu(menuName);
}

function MM_menuShowMenuContainer(containName, x, y, triggerName) {	
	var c = document.getElementById(containName);
	var s = c.style;
	s.visibility = "inherit";
	
	mmOpenContainer = "" + containName;
}