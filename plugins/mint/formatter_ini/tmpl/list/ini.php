# This is INI formated article list of section <?php echo $view->section->title ? $view->section->title : $view->section->name;?>
# generated by Formatter plugin.

<?php foreach ($view->items as $item):?>
[record <?php echo $item->id?>]
record.<?php echo $item->id?>.title="<?php echo $item->title;?>"
record.<?php echo $item->id?>.type="<?php echo $item->type_name;?>"
<?php foreach($item->categories AS $id => $cat):?>
record.<?php echo $item->id?>.categories<?php echo $id ?>.title="<?php echo $cat; ?>"
record.<?php echo $item->id?>.categories<?php echo $id ?>.id="<?php echo $id; ?>"
<?php endforeach; ?>
record.<?php echo $item->id?>.createDate="<?php echo $item->ctime?>"
<?php foreach ($item->fields_by_id as $field):?>
record.<?php echo $item->id?>.fields.<?php echo $field->params->get('core.xml_tag_name', strtolower(preg_replace("/^[^a-zA-z0-9\-_\.]*$/iU", "", $field->label))) ?>="<?php echo str_replace("\n","	", is_array($field->value) ? json_encode($field->value) : $field->value);?>"
<?php endforeach;?>


<?php endforeach;?>