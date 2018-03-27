<?php

/**
 * @file
 * Customize the display of a webform submission.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $submission: The Webform submission array.
 * - $email: If sending this submission in an e-mail, the e-mail configuration
 *   options.
 * - $format: The format of the submission being printed, either "html" or
 *   "text".
 * - $renderable: The renderable submission array, used to print out individual
 *   parts of the submission, just like a $form array.
 */
?>
<?php
/**
 * Fill a new 'OhneDich' node with the data of the submitted webform and save it to the database.
 */
// create a new node
$od_node = new stdClass();
$od_node->type = 'ohne_dich';
$od_node->language = LANGUAGE_NONE;
$od_node->uid = 1;
$od_node->status = (int)$node->field_publish_posts_immediately[LANGUAGE_NONE][0]['value'];
$od_node->comment = 0;
$od_node->promote = 0;
node_object_prepare($od_node);

// fill the node properties and save it to the database
$od_node->title = $submission->data[8]['value'][0] . " & " . $submission->data[10]['value'][0];
$od_node->field_picture[$od_node->language][0]['fid']         = $submission->data[3]['value'][0]; // fid
$od_node->field_person_links[$od_node->language][0]['value']  = $submission->data[4]['value'][0]; // Nationalität links
$od_node->field_person_rechts[$od_node->language][0]['value'] = $submission->data[5]['value'][0]; // Nationalität rechts
$od_node->field_quote[$od_node->language][0]['value']         = substr($submission->data[16]['value'][0], 0, 70); // Quote
$od_node->field_person_links_name[$od_node->language][0]['value']= $submission->data[8]['value'][0]; // Name links
$od_node->field_person_links_beruf[$od_node->language][0]['value']= $submission->data[9]['value'][0]; // Beruf links
$od_node->field_person_rechts_name[$od_node->language][0]['value']= $submission->data[10]['value'][0]; // Name rechts
$od_node->field_person_rechts_beruf[$od_node->language][0]['value']= $submission->data[11]['value'][0]; // Beruf rechts
$od_node = node_submit($od_node);
node_save($od_node);
?>

<?php print drupal_render_children($renderable); ?>
