// When you change APPName, be sure to update it in mylibs/util.js
// @see http://paulirish.com/2009/markup-based-unobtrusive-comprehensive-dom-ready-execution/
var P2PBOOKS = {
  
  toggleModal: function(bookId) {

    // If it's loading from a book listing click, grab the data for the book
    if (bookId) {
      P2PBOOKS.lookupBook(bookId, function(data) {
        if (data) {
          var book = JSON.parse(data);
          $(".modal .image").html('<img src="' + book.image + '" />');
          $(".modal .title").html(book.title);
          $(".modal .author").html(book.author);
          $(".modal .price").html(book.listPrice.toFixed(2));
          $(".modal .publisher").html(book.publisher);
          $(".modal .isbn").html(book.isbn);
          $(".modal .request-book").attr('data-bookid', book.id);
          $(".modal .request-book").attr('href', './buy.php?bookId=' + book.id);
          $(".modal-container").fadeToggle("fast");
        } else {
          console.log("error " + data);
        }
      })
    } else {
      $(".modal-container").fadeToggle("fast");
    }
    
  },

  closeModal: function() {
    $(".modal-container").fadeOut("fast");
  },

  requestBook: function(bookId) {
    $.post('./process.php',{ 'action': 'requestBook', 'bookId': bookId }, function(data) {
      console.log(data);
    })
  },

  initGoogleLookup: function() {
    var book;

    $( "#add-book-title" ).autocomplete({
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
                      value: item.id
                  }
              }));
          },
          error: function( data ) {
            alert("Error! " + data);
          }
      })
    },
    minLength: 2,
    select: function( event, ui ) {
        var id = ui.item.value;
        P2PBOOKS.mapGoogleBooks(id);
        //ui.item.value = ui.item.label;
    },
    open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
    },
    close: function() {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
    }
  });
  },

  mapGoogleBooks : function(id) {
    $.get('https://www.googleapis.com/books/v1/volumes?q={id:' + id + '}', function(data) {
      var book = data.items[0];
      console.log(book);
      $('.add-book #add-book-title').val(book.volumeInfo.title);
      if (book.volumeInfo.authors) {
        $('.add-book #author').val(book.volumeInfo.authors.join(', '));
      }
      $('.add-book #isbn').val(book.volumeInfo.industryIdentifiers[1].identifier);
      $('.add-book #publisher').val(book.volumeInfo.publisher);
      $('.add-book #image').val(book.volumeInfo.imageLinks.thumbnail);
      $('.add-book .image').html('<img src="' + book.volumeInfo.imageLinks.thumbnail + '" alt="Image" />');
    })
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
        if (e.keyCode == 27) { P2PBOOKS.closeModal(); }
      });

      $(".add-book").submit(function(e) {
        e.preventDefault();

        var data = $(this).serialize();
        data = data + '&action=addBook';

        $.post("./process.php", data, function(message) {
          console.log(message);
          $(".message").html('Your book has been added!').slideDown();
          $(".add-book")[0].reset();
          $(".image").html('<img src="http://placehold.it/128x197" />');
        })
      });

      /*
      $(".request-book").click(function() {
        var bookId = $(this).data('bookid');
        P2PBOOKS.requestBook(bookId);
      });
*/

    },
    finalize: function() {
      $('.cover-layout').imagesLoaded(function() {
        $('.cover-layout').masonry({
          itemSelector : '.book'
        });  
      });      
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