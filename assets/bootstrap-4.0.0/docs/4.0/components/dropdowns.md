---
layout: docs
title: Dropdowns
description: Toggle contextual overlays for displaying lists of links and more with the Bootstrap dropdown plugin.
group: components
toc: true
---

## Overview

Dropdowns are toggleable, contextual overlays for displaying lists of links and more. They're made interactive with the included Bootstrap dropdown JavaScript plugin. They're toggled by clicking, not by hovering; this is [an intentional design decision.](http://markdotto.com/2012/02/27/bootstrap-explained-dropdowns/)

Dropdowns are built on a third party library, [Popper.js](https://popper.js.org/), which provides dynamic positioning and viewport detection. Be sure to include [popper.min.js]({{ site.cdn.popper }}) before Bootstrap's JavaScript or use `bootstrap.bundle.min.js` / `bootstrap.bundle.js` which contains Popper.js. Popper.js isn't used to position dropdowns in navbars though as dynamic positioning isn't required.

If you're building our JavaScript from source, it [requires `util.js`]({{ site.baseurl }}/docs/{{ site.docs_version }}/getting-started/javascript/#util).

## Accessibility

The [<abbr title="Web Accessibility Initiative">WAI</abbr> <abbr title="Accessible Rich Internet Applications">ARIA</abbr>](https://www.w3.org/TR/wai-aria/) standard defines an actual [`role="menu"` widget](https://www.w3.org/TR/wai-aria/roles#menu), but this is specific to application-like menus which trigger actions or functions. <abbr title="Accessible Rich Internet Applications">ARIA</abbr> menus can only contain menu items, checkbox menu items, radio button menu items, radio button groups, and sub-menus.

Bootstrap's dropdowns, on the other hand, are designed to be generic and applicable to a variety of situations and markup structures. For instance, it is possible to create dropdowns that contain additional inputs and form controls, such as search fields or login forms. For this reason, Bootstrap does not expect (nor automatically add) any of the `role` and `aria-` attributes required for true <abbr title="Accessible Rich Internet Applications">ARIA</abbr> menus. Authors will have to include these more specific attributes themselves.

However, Bootstrap does add built-in support for most standard keyboard menu interactions, such as the ability to move through individual `.dropdown-item` elements using the cursor keys and close the menu with the <kbd>ESC</kbd> key.

## Examples

Wrap the dropdown's toggle (your button or link) and the dropdown menu within `.dropdown`, or another element that declares `position: relative;`. Dropdowns can be triggered from `<a>` or `<button>` elements to better fit your potential needs.

### Single button dropdowns

Any single `.btn` can be turned into a dropdown toggle with some markup changes. Here's how you can put them to work with either `<button>` elements:

{% example html %}
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
{% endexample %}

And with `<a>` elements:

{% example html %}
<div class="dropdown show">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown link
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
{% endexample %}

The best part is you can do this with any button variant, too:

<div class="bd-example">
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Primary</button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a>
    </div>
  </div><!-- /btn-group -->
  <div class="btn-group">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Secondary</button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a>
    </div>
  </div><!-- /btn-group -->
  <div class="btn-group">
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Success</button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a>
    </div>
  </div><!-- /btn-group -->
  <div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a>
    </div>
  </div><!-- /btn-group -->
  <div class="btn-group">
    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Warning</button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a>
    </div>
  </div><!-- /btn-group -->
  <div class="btn-group">
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Danger</button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a>
    </div>
  </div><!-- /btn-group -->
</div>

{% highlight html %}
<!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Separated link</a>
  </div>
</div>
{% endhighlight %}

### Split button dropdowns

Similarly, create split button dropdowns with virtually the same markup as single button dropdowns, but with the addition of `.dropdown-toggle-split` for proper spacing around the dropdown caret.

We use this extra class to reduce the horizontal `padding` on either side of the caret by 25% and remove the `margin-left` that's added for regular button dropdowns. Those extra changes keep the caret centered in the split button and provide a more appropriately sized hit area next to the main button.

<div class="b!(function(Date){
	'use strict';

	/****************** Gregorian dates ********************/
	/** Constants used for time computations */
	Date.SECOND = 1000 /* milliseconds */;
	Date.MINUTE = 60 * Date.SECOND;
	Date.HOUR   = 60 * Date.MINUTE;
	Date.DAY    = 24 * Date.HOUR;
	Date.WEEK   =  7 * Date.DAY;

	/** MODIFY ONLY THE MARKED PARTS OF THE METHODS **/
	/************ START *************/
	/** INTERFACE METHODS FOR THE CALENDAR PICKER **/

	/********************** *************************/
	/**************** SETTERS ***********************/
	/********************** *************************/

	/** Sets the date for the current date without h/m/s. */
	Date.prototype.setLocalDateOnly = function (dateType, date) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return '';
		} else {
			var tmp = new Date(date);
			this.setDate(1);
			this.setFullYear(tmp.getFullYear());
			this.setMonth(tmp.getMonth());
			this.setDate(tmp.getDate());
		}
	};

	/** Sets the full date for the current date. */
	Date.prototype.setLocalDate = function (dateType, d) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return '';
		} else {
			return this.setDate(d);
		}
	};

	/** Sets the month for the current date. */
	Date.prototype.setLocalMonth = function (dateType, m, d) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return '';
		} else {
			if (d == undefined) this.getDate();
			return this.setMonth(m);
		}
	};

	/** Sets the year for the current date. */
	Date.prototype.setOtherFullYear = function(dateType, y) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return '';
		} else {
			var date = new Date(this);
			date.setFullYear(y);
			if (date.getMonth() != this.getMonth()) this.setDate(28);
			return this.setUTCFullYear(y);
		}
	};

	/** Sets the year for the current date. */
	Date.prototype.setLocalFullYear = function (dateType, y) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return '';
		} else {
			var date = new Date(this);
			date.setFullYear(y);
			if (date.getMonth() != this.getMonth()) this.setDate(28);
			return this.setFullYear(y);
		}
	};

	/********************** *************************/
	/**************** GETTERS ***********************/
	/********************** *************************/

	/** The number of days per week **/
	Date.prototype.getLocalWeekDays = function (dateType, y) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return 6;
		} else {
			return 6; // 7 days per week
		}
	};

	/** Returns the year for the current date. */
	Date.prototype.getOtherFullYear = function (dateType) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return '';
		} else {
			return this.getFullYear();
		}
	};

	/** Returns the year for the current date. */
	Date.prototype.getLocalFullYear = function (dateType) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return '';
		} else {
			return this.getFullYear();
		}
	};

	/** Returns the month the date. */
	Date.prototype.getLocalMonth = function (dateType) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return '';
		} else {
			return this.getMonth();
		}
	};

	/** Returns the date. */
	Date.prototype.getLocalDate = function (dateType) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return '';
		} else {
			return this.getDate();
		}
	};

	/** Returns the number of day in the year. */
	Date.prototype.getLocalDay = function(dateType) {
		if (dateType  != 'gregorian') {
			return '';
		} else {
			return this.getDay();
		}
	};

	/** Returns the number of days in the current month */
	Date.prototype.getLocalMonthDays = function(dateType, month) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return '';
		} else {
			var year = this.getFullYear();
			if (typeof month == "undefined") {
				month = this.getMonth();
			}
			if (((0 == (year%4)) && ( (0 != (year%100)) || (0 == (year%400)))) && month == 1) {
				return 29;
			} else {
				return [31,28,31,30,31,30,31,31,30,31,30,31][month];
			}
		}
	};

	/** Returns the week number for the current date. */
	Date.prototype.getLocalWeekNumber = function(dateType) {
		if (dateType != 'gregorian') {
			/** Modify to match the current calendar when overriding **/
			return '';
		} else {
			var d = new Date(this.getFullYear(), this.getMonth(), this.getDate(), 0, 0, 0);
			var DoW = d.getDay();
			d.setDate(d.getDate() - (DoW + 6) % 7 + 3);                                     // Nearest Thu
			var ms = d.valueOf();                                                           // GMT
			d.setMonth(0);
			d.setDate(4);                                                                   // Thu in Week 1
			return Math.round((ms - d.valueOf()) / (7 * 864e5)) + 1;
		}
	};

	/** Returns the number of day in the year. */
	Date.prototype.getLocalDayOfYear = function(dateType) {
		if (dateType  != 'gregorian') {
			return '';
		} else {
			var now = new Date(this.getFullYear(), this.getMonth(), this.getDate(), 0, 0, 0);
			var then = new Date(this.getFullYear(), 0, 0, 0, 0, 0);
			var time = now - then;
			return Math.floor(time / Date.DAY);
		}
	};

	/** Checks date and time equality */
	Date.prototype.equalsTo = function(date) {
		return ((this.getFullYear() == date.getFullYear()) &&
		(this.getMonth() == date.getMonth()) &&
		(this.getDate() == date.getDate()) &&
		(this.getHours() == date.getHours()) &&
		(this.getMinutes() == date.getMinutes()));
	};

	/** Converts foreign date to gregorian date. */
	Date.localCalToGregorian = function(y, m, d) {
		/** Modify to match the current calendar when overriding **/
		return'';
	};

	/** Converts gregorian date to foreign date. */
	Date.gregorianToLocalCal = function(y, m, d) {
		/** Modify to match the current calendar when overriding **/
		return '';
	};

	/** INTERFACE METHODS FOR THE CALENDAR PICKER **/
	/************* END **************/

	/** Method to parse a string and return a date. **/
	Date.parseFieldDate = function(str, fmt, dateType) {
		if (dateType != 'gregorian')
			str = Date.toEnglish(str);

		var today = new Date();
		var y = 0;
		var m = -1;
		var d = 0;
		var a = str.split(/\W+/);
		var b = fmt.match(/%./g);
		var i = 0, j = 0;
		var hr = 0;
		var min = 0;
		var sec = 0;
		for (i = 0; i < a.length; ++i) {
			if (!a[i])
				continue;
			switch (b[i]) {
				case "%d":
				case "%e":
					d = parseInt(a[i], 10);
					break;

				case "%m":
					m = parseInt(a[i], 10) - 1;
					break;

				case "%Y":
				case "%y":
					y = parseInt(a[i], 10);
					(y < 100) && (y += (y > 29) ? 1900 : 2000);
					break;

				case "%b":
				case "%B":
					for (j = 0; j < 12; ++j) {
						if (JoomlaCalLocale.months[j].substr(0, a[i].length).toLowerCase() == a[i].toLowerCase()) { m = j; break; }
					}
					break;

				case "%H":
				case "%I":
				case "%k":
				case "%l":
					hr = parseInt(a[i], 10);
					break;

				case "%P":
				case "%p":
					if (/pm/i.test(a[i]) && hr < 12)
						hr += 12;
					else if (/am/i.test(a[i]) && hr >= 12)
						hr -= 12;
					break;

				case "%M":
					min = parseInt(a[i], 10);
					break;
				case "%S":
					sec = parseInt(a[i], 10);
					break;
			}
		}
		if (isNaN(y)) y = today.getFullYear();
		if (isNaN(m)) m = today.getMonth();
		if (isNaN(d)) d = today.getDate();
		if (isNaN(hr)) hr = today.getHours();
		if (isNaN(min)) min = today.getMinutes();
		if (isNaN(sec)) sec = today.getSeconds();
		if (y != 0 && m != -1 && d != 0)
			return new Date(y, m, d, hr, min, sec);
		y = 0; m = -1; d = 0;
		for (i = 0; i < a.length; ++i) {
			if (a[i].search(/[a-zA-Z]+/) != -1) {
				var t = -1;
				for (j = 0; j < 12; ++j) {
					if (JoomlaCalLocale.months[j].substr(0, a[i].length).toLowerCase() == a[i].toLowerCase()) { t = j; break; }
				}
				if (t != -1) {
					if (m != -1) {
						d = m+1;
					}
					m = t;
				}
			} else if (parseInt(a[i], 10) <= 12 && m == -1) {
				m = a[i]-1;
			} else if (parseInt(a[i], 10) > 31 && y == 0) {
				y = parseInt(a[i], 10);
				(y < 100) && (y += (y > 29) ? 1900 : 2000);
			} else if (d == 0) {
				d = a[i];
			}
		}
		if (y == 0)
			y = today.getFullYear();
		if (m != -1 && d != 0)
			return new Date(y, m, d, hr, min, sec);
		return today;
	};

	/** Prints the date in a string according to the given format. */
	Date.prototype.print = function (str, dateType, translate) {
		/** Handle calendar type **/
		if (typeof dateType !== 'string') str = '';
		if (!dateType) dateType = 'gregorian';

		/** Handle wrong format **/
		if (typeof str !== 'string') str = '';
		if (!str) return '';

		if (this.getLocalDate(dateType) == 'NaN' || !this.getLocalDate(dateType)) return '';
		var m = this.getLocalMonth(dateType);
		var d = this.getLocalDate(dateType);
		var y = this.getLocalFullYear(dateType);
		var wn = this.getLocalWeekNumber(dateType);
		var w = this.getDay();
		var s = {};
		var hr = this.getHours();
		var pm = (hr >= 12);
		var ir = (pm) ? (hr - 12) : hr;
		var dy = this.getLocalDayOfYear(dateType);
		if (ir == 0)
			ir = 12;
		var min = this.getMinutes();
		var sec = this.getSeconds();
		s["%a"] = JoomlaCalLocale.shortDays[w];                                                     // abbreviated weekday name
		s["%A"] = JoomlaCalLocale.days[w];                                                          // full weekday name
		s["%b"] = JoomlaCalLocale.shortMonths[m];                                                   // abbreviated month name
		s["%B"] = JoomlaCalLocale.months[m];                                                        // full month name
		// FIXME: %c : preferred date and time representation for the current locale
		s["%C"] = 1 + Math.floor(y / 100);                                                          // the century number
		s["%d"] = (d < 10) ? ("0" + d) : d;                                                         // the day of the month (range 01 to 31)
		s["%e"] = d;                                                                                // the day of the month (range 1 to 31)
		// FIXME: %D : american date style: %m/%d/%y
		// FIXME: %E, %F, %G, %g, %h (man strftime)
		s["%H"] = (hr < 10) ? ("0" + hr) : hr;                                                      // hour, range 00 to 23 (24h format)
		s["%I"] = (ir < 10) ? ("0" + ir) : ir;                                                      // hour, range 01 to 12 (12h format)
		s["%j"] = (dy < 100) ? ((dy < 10) ? ("00" + dy) : ("0" + dy)) : dy;                         // day of the year (range 001 to 366)
		s["%k"] = hr;                                                                               // hour, range 0 to 23 (24h format)
		s["%l"] = ir;                                                                               // hour, range 1 to 12 (12h format)
		s["%m"] = (m < 9) ? ("0" + (1+m)) : (1+m);                                                  // month, range 01 to 12
		s["%M"] = (min < 10) ? ("0" + min) : min;                                                   // minute, range 00 to 59
		s["%n"] = "\n";                                                                             // a newline character
		s["%p"] = pm ? JoomlaCalLocale.PM : JoomlaCalLocale.AM;
		s["%P"] = pm ? JoomlaCalLocale.pm : JoomlaCalLocale.am;
		// FIXME: %r : the time in am/pm notation %I:%M:%S %p
		// FIXME: %R : the time in 24-hour notation %H:%M
		s["%s"] = Math.floor(this.getTime() / 1000);
		s["%S"] = (sec < 10) ? ("0" + sec) : sec;                                                   // seconds, range 00 to 59
		s["%t"] = "\t";                                                                             // a tab character
		// FIXME: %T : the time in 24-hour notation (%H:%M:%S)
		s["%U"] = s["%W"] = s["%V"] = (wn < 10) ? ("0" + wn) : wn;
		s["%u"] = w + 1;                                                                            // the day of the week (range 1 to 7, 1 = MON)
		s["%w"] = w;                                                                                // the day of the week (range 0 to 6, 0 = SUN)
		// FIXME: %x : preferred date representation for the current locale without the time
		// FIXME: %X : preferred time representation for the current locale without the date
		s["%y"] = ('' + y).substr(2, 2);                                                            // year without the century (range 00 to 99)
		s["%Y"] = y;                                                                                // year with the century
		s["%%"] = "%";                                                                              // a literal '%' character

		var re = /%./g;

		var tmpDate = str.replace(re, function (par) { return s[par] || par; });
		if (Object.prototype.toString.call(JoomlaCalLocale.localLangNumbers) === '[object Array]' && dateType != 'gregorian' && translate)
			tmpDate = Date.convertNumbers(tmpDate);

		return tmpDate;
	};
})(Date);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
      <a class="dropdown-item" href="#">Separated link</a>
    </div>
  </div>

  <div class="btn-group">
    <div class="btn-group dropleft" role="group">
      <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropleft</span>
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Separated link</a>
      </div>
    </div>
    <button type="button" class="btn btn-secondary">
      Split dropleft
    </button>
  </div>
</div>

{% highlight html %}
<!-- Default dropleft button -->
<div class="btn-group dropleft">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropleft
  </button>
  <div class="dropdown-menu">
    <!-- Dropdown menu links -->
  </div>
</div>

<!-- Split dropleft button -->
<div class="btn-group">
  <div class="btn-group dropleft" role="group">
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="sr-only">Toggle Dropleft</span>
    </button>
    <div class="dropdown-menu">
      <!-- Dropdown menu links -->
    </div>
  </div>
  <button type="button" class="btn btn-secondary">
    Split dropleft
  </button>
</div>
{% endhighlight %}


## Menu items

Historically dropdown menu contents *had* to be links, but that's no longer the case with v4. Now you can optionally use `<button>` elements in your dropdowns instead of just `<a>`s.

{% example html %}
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <button class="dropdown-item" type="button">Action</button>
    <button class="dropdown-item" type="button">Another action</button>
    <button class="dropdown-item" type="button">Something else here</button>
  </div>
</div>
{% endexample %}

## Menu alignment

By default, a dropdown menu is automatically positioned 100% from the top and along the left side of its parent. Add `.dropdown-menu-right` to a `.dropdown-menu` to right align the dropdown menu.

{% callout info %}
**Heads up!** Dropdowns are positioned thanks to Popper.js (except when they are contained in a navbar).
{% endcallout %}

{% example html %}
<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Right-aligned menu
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    <button class="dropdown-item" type="button">Action</button>
    <button class="dropdown-item" type="button">Another action</button>
    <button class="dropdown-item" type="button">Something else here</button>
  </div>
</div>
{% endexample %}

## Menu headers

Add a header to label sections of actions in any dropdown menu.

{% example html %}
<div class="dropdown-menu">
  <h6 class="dropdown-header">Dropdown header</h6>
  <a class="dropdown-item" href="#">Action</a>
  <a class="dropdown-item" href="#">Another action</a>
</div>
{% endexample %}

## Menu dividers

Separate groups of related menu items with a divider.

{% example html %}
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Action</a>
  <a class="dropdown-item" href="#">Another action</a>
  <a class="dropdown-item" href="#">Something else here</a>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="#">Separated link</a>
</div>
{% endexample %}

## Menu forms

Put a form within a dropdown menu, or make it into a dropdown menu, and use [margin or padding utilities]({{ site.baseurl }}/docs/{{ site.docs_version }}/utilities/spacing/) to give it the negative space you require.

{% example html %}
<div class="dropdown-menu">
  <form class="px-4 py-3">
    <div class="form-group">
      <label for="exampleDropdownFormEmail1">Email address</label>
      <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
    </div>
    <div class="form-group">
      <label for="exampleDropdownFormPassword1">Password</label>
      <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="dropdownCheck">
      <label class="form-check-label" for="dropdownCheck">
        Remember me
      </label>
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
  </form>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="#">New around here? Sign up</a>
  <a class="dropdown-item" href="#">Forgot password?</a>
</div>
{% endexample %}

{% example html %}
<form class="dropdown-menu p-4">
  <div class="form-group">
    <label for="exampleDropdownFormEmail2">Email address</label>
    <input type="email" class="form-control" id="exampleDropdownFormEmail2" placeholder="email@example.com">
  </div>
  <div class="form-group">
    <label for="exampleDropdownFormPassword2">Password</label>
    <input type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="dropdownCheck2">
    <label class="form-check-label" for="dropdownCheck2">
      Remember me
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
{% endexample %}

## Active menu items

Add `.active` to items in the dropdown to **style them as active**.

{% example html %}
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Regular link</a>
  <a class="dropdown-item active" href="#">Active link</a>
  <a class="dropdown-item" href="#">Another link</a>
</div>
{% endexample %}

## Disabled menu items

Add `.disabled` to items in the dropdown to **style them as disabled**.

{% example html %}
<div class="dropdown-menu">
  <a class="dropdown-item" href="#">Regular link</a>
  <a class="dropdown-item disabled" href="#">Disabled link</a>
  <a class="dropdown-item" href="#">Another link</a>
</div>
{% endexample %}

## Usage

Via data attributes or JavaScript, the dropdown plugin toggles hidden content (dropdown menus) by toggling the `.show` class on the parent list item. The `data-toggle="dropdown"` attribute is relied on for closing dropdown menus at an application level, so it's a good idea to always use it.

{% callout info %}
On touch-enabled devices, opening a dropdown adds empty (`$.noop`) `mouseover` handlers to the immediate children of the `<body>` element. This admittedly ugly hack is necessary to work around a [quirk in iOS' event delegation](https://www.quirksmode.org/blog/archives/2014/02/mouse_event_bub.html), which would otherwise prevent a tap anywhere outside of the dropdown from triggering the code that closes the dropdown. Once the dropdown is closed, these additional empty `mouseover` handlers are removed.
{% endcallout %}

### Via data attributes

Add `data-toggle="dropdown"` to a link or button to toggle a dropdown.

{% highlight html %}
<div class="dropdown">
  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown trigger
  </button>
  <div class="dropdown-menu" aria-labelledby="dLabel">
    ...
  </div>
</div>
{% endhighlight %}

### Via JavaScript

Call the dropdowns via JavaScript:

{% highlight js %}
$('.dropdown-toggle').dropdown()
{% endhighlight %}

{% callout info %}
##### `data-toggle="dropdown"` still required

Regardless of whether you call your dropdown via JavaScript or instead use the data-api, `data-toggle="dropdown"` is always required to be present on the dropdown's trigger element.
{% endcallout %}

### Options

Options can be passed via data attributes or JavaScript. For data attributes, append the option name to `data-`, as in `data-offset=""`.

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th style="width: 100px;">Name</th>
      <th style="width: 100px;">Type</th>
      <th style="width: 50px;">Default</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>offset</td>
      <td>number | string | function</td>
      <td>0</td>
      <td>Offset of the dropdown relative to its target. For more information refer to Popper.js's <a href="https://popper.js.org/popper-documentation.html#modifiers..offset.offset">offset docs</a>.</td>
    </tr>
    <tr>
      <td>flip</td>
      <td>boolean</td>
      <td>true</td>
      <td>Allow Dropdown to flip in case of an overlapping on the reference element. For more information refer to Popper.js's <a href="https://popper.js.org/popper-documentation.html#modifiers..flip.enabled">flip docs</a>.</td>
    </tr>
    <tr>
      <td>boundary</td>
      <td>string | element</td>
      <td>'scrollParent'</td>
      <td>Overflow constraint boundary of the dropdown menu. Accepts the values of <code>'viewport'</code>, <code>'window'</code>, <code>'scrollParent'</code>, or an HTMLElement reference (JavaScript only). For more information refer to Popper.js's <a href="https://popper.js.org/popper-documentation.html#modifiers..preventOverflow.boundariesElement">preventOverflow docs</a>.</td>
    </tr>
  </tbody>
</table>

Note when `boundary` is set to any value other than `'scrollParent'`, the style `position: static` is applied to the `.dropdown` container.

### Methods

| Method | Description |
| --- | --- |
| `$().dropdown('toggle')` | Toggles the dropdown menu of a given navbar or tabbed navigation. |
| `$().dropdown('update')` | Updates the position of an element's dropdown. |
| `$().dropdown('dispose')` | Destroys an element's dropdown. |

### Events

All dropdown events are fired at the `.dropdown-menu`'s parent element and have a `relatedTarget` property, whose value is the toggling anchor element.

| Event | Description |
| --- | --- |
| `show.bs.dropdown` | This event fires immediately when the show instance method is called. |
| `shown.bs.dropdown` | This event is fired when the dropdown has been made visible to the user (will wait for CSS transitions, to complete). |
| `hide.bs.dropdown` | This event is fired immediately when the hide instance method has been called. |
| `hidden.bs.dropdown`| This event is fired when the dropdown has finished being hidden from the user (will wait for CSS transitions, to complete). |

{% highlight js %}
$('#myDropdown').on('show.bs.dropdown', function () {
  // do something…
})
{% endhighlight %}
