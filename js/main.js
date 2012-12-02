// When you change APPName, be sure to update it in mylibs/util.js
// @see http://paulirish.com/2009/markup-based-unobtrusive-comprehensive-dom-ready-execution/
var P2PBOOKS = {
  
  toggleModal: function(bookId) {

    // If it's loading from a book listing click, grab the data for the book
    if (bookId) {
      P2PBOOKS.lookupBook(bookId, function(data) {
        if (data) {
          var book = JSON.parse(data);
          $(".modal .title").html(book.title);
          $(".modal .author").html(book.author);
          $(".modal .price").html(book.listPrice);
          $(".modal-container").fadeToggle("fast");    
        } else {
          console.log("error " + data);
        }
      })
    } else {
      $(".modal-container").fadeToggle("fast");
    }
    
  },

  initGoogleLookup: function() {
    $( "#add-book" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "https://www.googleapis.com/books/v1/volumes?",
          dataType: "jsonp",
          data: {
            q: request.term
          },
          success: function( data ) {
              response( 
                $.map( data.items, function( item ) {
                  return {
                      label: item.volumeInfo.title,
                      value: item.volumeInfo.title
                  }
              }));
          },
          error: function( data ) {
            alert("Error! " + data);
          }
      });
    },
    minLength: 2,
    select: function( event, ui ) {
        log( ui.item ?
            "Selected: " + ui.item.label :
            "Nothing selected, input was " + this.value);
    },
    open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
    },
    close: function() {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
    }
  });
  },

  lookupBook : function(bookId, cb) {
    if (bookId) {
      // Run Process.php lookup function, return object of results
      $.get('./process.php',{
          'action': 'lookupBook',
          'bookId': bookId
        },
        function(data) {
          cb(data);
        });

    } else {
      return cb(false);
    }
  },
  
  // Initializers
  common: {
    init: function() { 
      $(".book").click(function() {
        var bookId = $(this).data('bookid');
        P2PBOOKS.toggleModal(bookId);
      });

      $(".close").click(function() {
        P2PBOOKS.toggleModal();
      });

      $(".modal-container").click(function() {
        P2PBOOKS.toggleModal();
      })

      $(".modal").click(function(e) {
        e.stopPropagation();
      });

      P2PBOOKS.initGoogleLookup();

      $(document).keyup(function(e) {
        if (e.keyCode == 27) { P2PBOOKS.toggleModal(); }
      });

    },
    finalize: function() {
      
    }
  },
  
  bodyId_or_className: {
    init: function() { 

    },
    finalize: function() { 
      
    }
  }
};

UTIL = {
  fire: function( func,funcname, args ) {
    var namespace = P2PBOOKS;  // indicate your obj literal namespace here
 
    funcname = ( funcname === undefined ) ? 'init' : funcname;
    if ( func !== '' && namespace[ func ] && typeof namespace[ func ][ funcname ] == 'function' ) {
      namespace[ func ][ funcname ]( args );
    }
  },
  loadEvents: function() {
    var bodyId = document.body.id;
 
    // hit up common first.
    UTIL.fire( 'common' );
 
    // do all the classes too.
    $.each( document.body.className.split( /\s+/ ), function( i, classnm ) {
      UTIL.fire( classnm );
      UTIL.fire( classnm, bodyId );
    });
    UTIL.fire( 'common', 'finalize' );
  }
};

$(document).ready(UTIL.loadEvents);