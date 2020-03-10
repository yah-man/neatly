<?php
defined( 'ABSPATH' ) || exit;
/**
 * Extra content chat
 *
 * @package Neatly
 */

/* Auto-add paragraphs to the chat text. */
add_filter( 'neatly_extra_content_chat_text', 'wpautop' );

function neatly_content_format_chat($content) {
  global $_post_format_chat_ids;

  /* Set the global variable of speaker IDs to a new, empty array for this chat. */
  $_post_format_chat_ids = array();

  /* Allow the separator (separator for speaker/text) to be filtered. */
  $separator = ': ';

  /* Open the chat transcript div and give it a unique ID based on the post ID. */
  $chat_output = "\n\t\t\t" . '<div id="chat_box-' . esc_attr( get_the_ID() ) . '" class="chat_box">';

  /* Split the content to get individual chat rows. */
  $chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

  $i = 1;
  /* Loop through each row and format the output. */
  foreach ( $chat_rows as $chat_row ) {

    /* If a speaker is found, create a new chat row with speaker and text. */
    if ( strpos( $chat_row, $separator ) ) {

      /* Split the chat row into author/text. */
      $chat_row_split = explode( $separator, trim( $chat_row ), 2 );

      /* Get the chat author and strip tags. */
      $chat_author = strip_tags( trim( $chat_row_split[0] ) );

      /* Get the chat text. */
      $chat_text = trim( $chat_row_split[1] );

      /* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
      $speaker_id = neatly_content_format_chat_row_id( $chat_author );

      if($i%2 == 0) {
        $f_row_r = 'ta_r chat_R ';
      }else{
        $f_row_r = '';
      }

      /* Open the chat row. */
      $chat_output .= "\n\t\t\t\t" . '<div class="chat_row mb_L ' . $f_row_r . sanitize_html_class( "chat_speaker-{$speaker_id}" ) . '">';

      /* Add the chat row author. */
      $chat_output .= "\n\t\t\t\t\t" . '<div class="chat_author mb8 ' . sanitize_html_class( "chat_author-{$speaker_id}" ) . ' ">' . $chat_author. '</div>';

      /* Add the chat row text. */

      $chat_output .= "\n\t\t\t\t\t" . '<div class="chat_text comment_text br4 p12 dib relative"><p>' . str_replace( array( "\r", "\n", "\t" ), '', $chat_text ) . '</div>';

      /* Close the chat row. */
      $chat_output .= "\n\t\t\t\t" . '</div><!-- .chat_row -->';

      ++$i;
    } else {

      /* Make sure we have text. */
      if ( !empty( $chat_row ) ) {

        /* Open the chat row. */
        $chat_output .= $chat_row;
      }
    }
  }

  /* Close the chat transcript div. */
  $chat_output .= "\n\t\t\t</div><!-- .chat_box -->\n";

  /* Return the chat content and apply filters for developers. */
  return apply_filters( 'neatly_content_format_chat_content', $chat_output );


      //return $chat_output;
}

function neatly_content_format_chat_row_id( $chat_author ) {
  global $_post_format_chat_ids;

  /* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
  $chat_author = strtolower( strip_tags( $chat_author ) );

  /* Add the chat author to the array. */
  $_post_format_chat_ids[] = $chat_author;

  /* Make sure the array only holds unique values. */
  $_post_format_chat_ids = array_unique( $_post_format_chat_ids );

  /* Return the array key for the chat author and add "1" to avoid an ID of "0". */
  return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}