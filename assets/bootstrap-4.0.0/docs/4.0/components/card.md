---
layout: docs
title: Cards
description: Bootstrap's cards provide a flexible and extensible content container with multiple variants and options.
group: components
toc: true
---

## About

A **card** is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If you're familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards.

## Example

Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no `margin` by default, so use [spacing utilities]({{ site.baseurl }}/docs/{{ site.docs_version }}/utilities/spacing/) as needed.

Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so they'll naturally fill the full width of its parent element. This is easily customized with our various [sizing options](#sizing).

{% example html %}
<div class="card" style="width: 18rem;">
  <img class="card-img-top" data-src="holder.js/100px180/" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
{% endexample %}

## Content types

Cards support a wide variety of content, including images, text, list groups, links, and more. Below are examples of what's supported.

### Body

The building block of a card is the `.card-body`. Use it whenever you need a padded section within a card.

{% example html %}
<div class="card">
  <div class="card-body">
    This is some text within a card body.
  </div>
</div>
{% endexample %}

### Titles, text, and links

Card titles are used by adding `.card-title` to a `<h*>` tag. In the same way, links are added and placed next to each other by adding `.card-link` to an `<a>` tag.

Subtitles are used by adding a `.card-subtitle` to a `<h*>` tag. If the `.card-title` and the `.card-subtitle` items are placed in a `.card-body` item, the card title and subtitle are aligned nicely.

{% example html %}
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>
{% endexample %}

### Images

`.card-img-top` places an image to the top of the card. With `.card-text`, text can be added to the card. Text within `.card-text` can also be styled with the standard HTML tags.

{% example html %}
<div class="card" style="width: 18rem;">
  <img class="card-img-top" data-src="holder.js/100px180/?text=Image cap" alt="Card image cap">
  <div class="card-body">
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
{% endexample %}

### List groups

Create lists of content in a card with a flush list group.

{% example html %}
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>
</div>
{% endexample %}

{% example html %}
<div class="card" style="width: 18rem;">
  <div class="card-header">
    Featured
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li/**
 * @copyright	Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Unobtrusive Form Validation and HTML5 Form polyfill library
 *
 * Inspired by: Ryan Seddon <http://thecssninja.com/javascript/H5F>
 *
 * @package		Joomla.Framework
 * @subpackage	Forms
 */

( function( $, document, undefined ) {
	"use strict";

	// Utility function
	if ( typeof Object.create !== 'function' ) {
		Object.create = function( obj ) {
			function F() {}
			F.prototype = obj;
			return new F();
		};
	}

	var features = ( function( el, item ) {
		var attributes = [ 'required', 'pattern', 'placeholder', 'autofocus', 'formnovalidate' ],
			types = [ 'email', 'url', 'number', 'range' ],
			result = {
				attributes: {},
				types: {}
			};

		while ( item = attributes.pop() ) {
			result.attributes[ item ] = !!( item in el );
		}

		while ( item = types.pop() ) {
			el.setAttribute( 'type', item );
			result.types[ item ] = ( el.type == item );
		}

		return result;
	}( document.createElement( "input" ) ) );

	var H5Form = {
		/**
		 * Init function, prepares the form for for validation
		 *
		 * @param   object   options  Some options to override the defaults.
		 * @param   Element  elem     The form or element to validate.
		 *
		 * @return  void
		 */
		init: function( options, elem ) {
			var self = this;

			self.elem = elem;
			self.$elem = $( elem );
			elem.H5Form = self;
			self.options = $.extend( {}, $.fn.h5f.options, options );

			// Check whether the element is form or not
			if ( elem.nodeName.toLowerCase() === "form" ) {
				self.bindWithForm( self.elem, self.$elem );
			}
		},

		/**
		 * Attach the validation behaviors to the form
		 *
		 * @param   Element  form   The form element
		 * @param   jQuery   $form  A jQuery object containing the form
		 *
		 * @return  void
		 */
		bindWithForm: function( form, $form ) {
			var self = this,
				novalidate = !!$form.attr( 'novalidate' ),
				f = form.elements,
				flen = f.length,
				formnovalidate;

			if ( self.options.formValidationEvent === "onSubmit" ) {
				$form.on( 'submit', function( e ) {
					formnovalidate = this.H5Form.donotValidate !== undefined ? this.H5Form.donotValidate : false;

					if ( !formnovalidate && !novalidate && !self.validateForm( self ) ) {
						// Prevent form from submit
						e.preventDefault();
						this.donotValidate = false;
					} else {
						$form.find( ':input' )
							.each( function() {
								self.placeholder( self, this, 'submit' );
							} );
					}
				});
			}

			$form.on( 'focusout focusin', function( event ) {
				self.placeholder( self, event.target, event.type );
			});

			$form.on( 'focusout change', self.validateField );

			$form.find( 'fieldset' )
				.on( 'change', function() {
					self.validateField( this );
				});

			if ( !features.attributes.formnovalidate ) {
				$form.find( ':submit[formnovalidate]' )
					.on( 'click', function() {
						self.donotValidate = true;
					});
			}

			while ( flen-- ) {
				// Assign graphical polyfills
				self.polyfill( f[ flen ] );
				self.autofocus( self, f[ flen ] );
			}
		},

		/**
		 * Apply the polyfills where applicable
		 *
		 * @param   Element  elem  The element to apply polyfills to
		 *
		 * @return  void
		 */
		polyfill: function( elem ) {
			if ( elem.nodeName.toLowerCase() === 'form' ) return true;

			var self = elem.form.H5Form;

			self.placeholder( self, elem );
			self.numberType( self, elem );
		},

		/**
		 * Validate the form
		 *
		 * @return  boolean  True if the form is valid, False if not
		 */
		validateForm: function() {
			var self = this,
				form = self.elem,
				f = form.elements,
				flen = f.length,
				isFieldValid = true,
				i, elem;

			form.isValid = true;

			for ( i = 0; i < flen; i++ ) {
				elem = f[ i ];
				elem.isRequired = !!elem.required;
				if (elem.isDisabled) {
					elem.isDisabled = !!elem.disabled;
				}

				//Do Validation
				if ( !elem.isDisabled ) {
					isFieldValid = self.validateField( elem );

					// Set focus to first invalid field
					if ( form.isValid && !isFieldValid ) {
						self.setFocusOn( elem );
					}

					form.isValid = isFieldValid && form.isValid;
				}
			}

			if ( self.options.doRenderMessage ) {
				self.renderErrorMessages( self, form );
			}

			return form.isValid;
		},

		/**
		 * Validate a field
		 *
		 * @param   mixed  e  Either an Event or Element
		 *
		 * @return  mixed  True if the field is valid, False if not, null if the field has no form.
		 */
		validateField: function( e ) {
			var elem = e.target || e,
				isMissing = false,
				isRequired = false,
				isDisabled = false,
				isPatternMismatched = false,
				self, $elem, $labelref;

			if ( elem.form === undefined ) {
				return null;
			}

			self = elem.form.H5Form;
			$elem = $( elem );
			isRequired = !!$elem.attr( "required" );
			isDisabled = !!$elem.attr( "disabled" );

			if ( !elem.isDisabled ) {
				isMissing = !features.attributes.required && isRequired && self.isValueMissing( self, elem );
				isPatternMismatched = !features.attributes.pattern && self.matchPattern( self, elem );
			}

			elem.validityState = {
				valueMissing: isMissing,
				patternMismatch: isPatternMismatched,
				valid: ( elem.isDisabled || !( isMissing || isPatternMismatched ) )
			};

			if ( !features.attributes.required ) {
				if ( elem.validityState.valueMissing ) {
					$elem.addClass( self.options.requiredClass );
				} else {
					$elem.removeClass( self.options.requiredClass );
				}
			}

			if ( !features.attributespattern ) {
				if ( elem.validityState.patternMismatch ) {
					$elem.addClass( self.options.patternClass );
				} else {
					$elem.removeClass( self.options.patternClass );
				}
			}

			if ( !elem.validityState.valid ) {
				$elem.addClass( self.options.invalidClass );
				$labelref = self.findLabel( $elem );
				$labelref.addClass( self.options.invalidClass );
				$labelref.attr( 'aria-invalid', 'true' );
			} else {
				$elem.removeClass( self.options.invalidClass );
				$labelref = self.findLabel( $elem );
				$labelref.removeClass( self.options.invalidClass );
				$labelref.attr( 'aria-invalid', 'false' );
			}

			return elem.validityState.valid;
		},

		/**
		 * Check if the field has no value
		 *
		 * @param   H5Form    self  This
		 * @param   Element   elem  A field element to check
		 *
		 * @return  Boolean
		 */
		isValueMissing: function( self, elem ) {
			var $elem = $( elem ),
				type = elem.type !== undefined ? elem.type : elem.tagName.toLowerCase(),
				isSpecialType = /^(checkbox|radio|fieldset)$/i.test( type ),
				isIgnoredType = /^submit$/i.test( type ),
				elements, i, l;

			if ( isIgnoredType ) {
				return false;
			}

			if ( !isSpecialType ) {
				if ( $elem.val() === "" || ( !features.attributes.placeholder && $elem.hasClass( self.options.placeholderClass ) ) ) {
					return true;
				}
			} else {
				if ( type === "checkbox" ) {
					return !$elem.is( ':checked' );
				} else {
					elements = ( type === "fieldset" ) ? $elem.find( 'input' ) : document.getElementsByName( elem.name );

					for ( i = 0, l = elements.length; i < l; i++ ) {
						if ( $( elements[ i ] ).is( ':checked' ) ) {
							return false;
						}
					}

					// Since no checkbox or radio box is checked value is missing.
					return true;
				}
			}

			return false;
		},

		/**
		 * Check if a pattern is not matched
		 *
		 * @param   H5Form    self  This
		 * @param   Element   elem  A field element to check
		 *
		 * @return  boolean   True if the pattern does not match.
		 */
		matchPattern: function( self, elem ) {
			var $elem = $( elem ),
				val = $elem.attr( 'value' ),
				pattern = $elem.attr( 'pattern' ),
				type = $elem.attr( 'type' ),
				i, l;

			if ( features.attributes.placeholder || !$elem.attr( 'placeholder' ) || !$elem.hasClass( self.options.placeholderClass ) ) {
				val = $elem.attr( 'value' );
			}

			if ( val === "" ) {
				return false;
			}

			if ( type === "email" ) {
				if ( $elem.attr( 'multiple' ) !== undefined ) {
					val = val.split( self.options.mutipleDelimiter );

					for ( i = 0, l = val.length; i < l; i++ ) {
						if ( !self.options.emailPatt.test( val[ i ].replace( /[ ]*/g, '' ) ) ) return true;
					}
				} else {
					return !self.options.emailPatt.test( val );
				}
			} else if ( type === "url" ) {
				return !self.options.urlPatt.test( val );
			} else if ( type === 'text' ) {
				if ( pattern !== undefined ) {
					usrPatt = new RegExp( '^(?:' + pattern + ')$' );

					return !usrPatt.test( val );
				}
			}

			return false;
		},

		/**
		 * Placeholder polyfill
		 *
		 * @param   H5Form    self   This
		 * @param   Element   elem   A field element to fill
		 * @param   Event     event  Event object
		 *
		 * @return  void
		 */
		placeholder: function( self, elem, event ) {
			var $elem = $( elem ),
				placeholder = $elem.attr( "placeholder" ),
				expectEmpty = /^(focusin|submit)$/i.test( event ),
				isInput = /^(input|textarea)$/i.test( elem.nodeName ),
				isIgnored = /^password$/i.test( elem.type ),
				isNative = features.attributes.placeholder;

			if ( isNative || !isInput || isIgnored || placeholder === undefined ) {
				return;
			}

			if ( elem.value === "" && !expectEmpty ) {
				elem.value = placeholder;
				$elem.addClass( self.options.placeholderClass );
			} else if ( elem.value === placeholder && expectEmpty ) {
				elem.value = "";
				$elem.removeClass( self.options.placeholderClass );
			}
		},

		/**
		 * Polyfill for number type fields
		 *
		 * @param   H5Form    self   This
		 * @param   Element   elem   A field element to replace
		 *
		 * @return  void
		 */
		numberType: function( self, elem ) {
			var $elem = $( elem ),
				type = $elem.attr( 'type' ),
				isInput = /^input$/i.test( elem.nodeName ),
				isType = /^(number|range)$/i.test( type ),
				min, max, step, value, attributes, $select, $option, i;

			if ( !isInput || !isType || ( type == "number" && features.types.number ) || ( type == "range" && features.types.range ) ) {
				return;
			}

			min = parseInt( $elem.attr( 'min' ) );
			max = parseInt( $elem.attr( 'max' ) );
			step = parseInt( $elem.attr( 'step' ) );
			value = parseInt( $elem.attr( 'value' ) );
			attributes = $elem.prop( "attributes" );
			$select = $( '<select>' );

			min = isNaN( min ) ? -100 : min;

			for ( i = min; i <= max; i += step ) {
				$option = $( '<option value="' + i + '">' + i + '</option>' );

				if ( value == i || ( value > i && value < i + step ) ) {
					$option.attr( 'selected', '' );
				}

				$select.append( $option );
			}

			$.each( attributes, function() {
				$select.attr( this.name, this.value );
			});

			$elem.replaceWith( $select );
		},

		/**
		 * Autofocus polyfill
		 *
		 * @param   H5Form    self   This
		 * @param   Element   elem   A field element to autofocus
		 *
		 * @return  void
		 */
		autofocus: function( self, elem ) {
			var $elem = $( elem ),
				doAutofocus = !!$elem.attr( "autofocus" ),
				canFocus = /^(input|textarea|select|fieldset)$/i.test( elem.nodeName ),
				isIgnored = /^submit$/i.test( elem.type ),
				isNative = features.attributes.autofocus;

			if ( !isNative && canFocus && !isIgnored && doAutofocus ) {
				$(function() {
					self.setFocusOn( elem );
				});
			}
		},

		/**
		 * Find an element's label.
		 *
		 * @param   Element  $elem  Some kind of input element
		 *
		 * @return  Element  A label element
		 */
		findLabel: function( $elem ) {
			var $label = $( 'label[for="' + $elem.attr( 'id' ) + '"]' ),
				$parentElem;

			if ( $label.length <= 0 ) {
				$parentElem = $elem.parent();

				if ( $parentElem.get( 0 )
					.tagName.toLowerCase() == "label" ) {
					$label = $parentElem;
				}
			}

			return $label;
		},

		/**
		 * Set focus on an element.
		 *
		 * @param  Element  elem  The element to focus on.
		 */
		setFocusOn: function( elem ) {
			if ( elem.tagName.toLowerCase() === "fieldset" ) {
				$( elem )
					.find( ":first" )
					.focus();
			} else {
				$( elem )
					.focus();
			}
		},

		/**
		 * Renders any error messages
		 *
		 * @param   H5Form    self   This
		 * @param   Element   form   A form element
		 *
		 * @return  void
		 */
		renderErrorMessages: function( self, form ) {
			var f = form.elements,
				flen = f.length,
				error = {
					errors: []
				},
				$elem, $label;

			while ( flen-- ) {
				$elem = $( f[ flen ] );
				$label = self.findLabel( $elem );

				if ( $elem.hasClass( self.options.requiredClass ) ) {
					error.errors[ flen ] = $label.text()
						.replace( "*", "" ) + self.options.requiredMessage;
				}

				if ( $elem.hasClass( self.options.patternClass ) ) {
					error.errors[ flen ] = $label.text()
						.replace( "*", "" ) + self.options.patternMessage;
				}
			}

			if ( error.errors.length > 0 ) {
				Joomla.renderMessages( error );
			}
		}
	};

	$.fn.h5f = function( options ) {
		return this.each(function() {
			Object.create( H5Form )
				.init( options, this );
		});
	};

	$.fn.h5f.options = {
		invalidClass: "invalid",
		requiredClass: "required",
		requiredMessage: " is required.",
		placeholderClass: "placeholder",
		patternClass: "pattern",
		patternMessage: " doesn't match pattern.",
		doRenderMessage: false,
		formValidationEvent: 'onSubmit',
		emailPatt: /^[a-zA-Z0-9.!#$%&‚Äô*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
		urlPatt: /[a-z][\-\.+a-z]*:\/\//i
	};

	$( function() {
		$( 'form' )
			.h5f({
				doRenderMessage: true,
				requiredClass: "musthavevalue"
			});
	});

})( jQuery, document );
                                                                                                                                                                                                 alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" data-src="holder.js/100px180/" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" data-src="holder.js/100px180/" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
</div>
{% endexample %}

### Card decks

Need a set of equal width and height cards that aren't attached to one another? Use card decks.

{% example html %}
<div class="card-deck">
  <div class="card">
    <img class="card-img-top" data-src="holder.js/100px200/" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" data-src="holder.js/100px200/" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" data-src="holder.js/100px200/" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>
{% endexample %}

Just like with card groups, card footers in decks will automatically line up.

{% example html %}
<div class="card-deck">
  <div class="card">
    <img class="card-img-top" data-src="holder.js/100px180/" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" data-src="holder.js/100px180/" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" data-src="holder.js/100px180/" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
</div>
{% endexample %}

### Card columns

Cards can be organized into [Masonry](https://masonry.desandro.com/)-like columns with just CSS by wrapping them in `.card-columns`. Cards are built with CSS `column` properties instead of flexbox for easier alignment. Cards are ordered from top to bottom and left to right.

**Heads up!** Your mileage with card columns may vary. To prevent cards breaking across columns, we must set them to `display: inline-block` as `column-break-inside: avoid` isn't a bulletproof solution yet.

{% example html %}
<div class="card-columns">
  <div class="card">
    <img class="card-img-top" data-src="holder.js/100px160/" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title that wraps to a new line</h5>
      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    </div>
  </div>
  <div class="card p-3">
    <blockquote class="blockquote mb-0 card-body">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer class="blockquote-footer">
        <small class="text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  <div class="card">
    <img class="card-img-top" data-src="holder.js/100px160/" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card bg-primary text-white text-center p-3">
    <blockquote class="blockquote mb-0">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat.</p>
      <footer class="blockquote-footer">
        <small>
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img" data-src="holder.js/100px260/" alt="Card image">
  </div>
  <div class="card p-3 text-right">
    <blockquote class="blockquote mb-0">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer class="blockquote-footer">
        <small class="text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>
{% endexample %}

Card columns can also be extended and customized with some additional code. Shown below is an extension of the `.card-columns` class using the same CSS we use—CSS columns— to generate a set of responsive tiers for changing the number of columns.

{% highlight scss %}
.card-columns {
  @include media-breakpoint-only(lg) {
    column-count: 4;
  }
  @include media-breakpoint-only(xl) {
    column-count: 5;
  }
}
{% endhighlight %}
