<?php

/**
 * Columns Plugin
 *
 * @author Bastian Allgeier <bastian@getkirby.com>
 * @version 1.0.0
 *
 */

Kirby::plugin('calliope/columnsTag', [
  'hooks' => [
      'kirbytext:before' => function ($text) {

          // KirbyTags have not been parsed
          $text = preg_replace_callback('!\(columns(…|\.{3})\)(.*?)\((…|\.{3})columns\)!is', function($matches) {
            $columns = preg_split('!(\n|\r\n)\+{4}\s+(\n|\r\n)!', $matches[2]);
            $html    = array();
            $count   = count($columns);

            foreach($columns as $column) {
              $html[] = '<div class="col-'.$count.'">' . kirbytext(trim($column)) . '</div>';
            }

            return '<div class="cols">' . implode($html) . '</div>';

          }, $text);

          return $text;

      },
  ]
]);
