<?php

declare(strict_types=1);

$header = <<<'EOF'
        _    __                  _                                     _
       | |  / /                 | |                                   | |
       | | / /                  | |                                   | |
       | |/ / _   _  ____   ____| | ______ ____   _____ ______   ____ | | __
       | |\ \| | | |/ __ \ / __ \ |/ /  __/ __ \ / __  | _  _ \ / __ \| |/ /
       | | \ \ \_| | <__> |  ___/   <| / | <__> | <__| | |\ |\ | <__> |   <
    By |_|  \_\__  |\___  |\____|_|\_\_|  \____^_\___  |_||_||_|\____^_\|\_\
                 | |    | |                          | |
              ___/ | ___/ |                          | |
             |____/ |____/                           |_|

    A PocketMine-MP plugin that shows information about ranks in the server
    Copyright (C) 2020-2023 Kygekraqmak, KygekTeam

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    EOF;

$config = new PhpCsFixer\Config();

return $config->setRules([
    'align_multiline_comment' => [
        'comment_type' => 'phpdocs_only'
    ],
    'array_indentation' => true,
    'array_syntax' => [
        'syntax' => 'short'
    ],
    'binary_operator_spaces' => [
        'default' => 'single_space'
    ],
    'blank_line_after_namespace' => true,
    'blank_line_after_opening_tag' => true,
    'blank_line_before_statement' => [
        'statements' => [
            'declare'
        ]
    ],
    'cast_spaces' => [
        'space' => 'single'
    ],
    'concat_space' => [
        'spacing' => 'one'
    ],
    'declare_strict_types' => true,
    'elseif' => true,
    'fully_qualified_strict_types' => true,
    'global_namespace_import' => [
        'import_constants' => true,
        'import_functions' => true,
        'import_classes' => null,
    ],
    'header_comment' => [
        'comment_type' => 'comment',
        'header' => $header,
        'location' => 'after_open'
    ],
    'indentation_type' => true,
    'logical_operators' => true,
    'native_constant_invocation' => [
        'scope' => 'namespaced'
    ],
    'native_function_invocation' => [
        'scope' => 'namespaced',
        'include' => ['@all'],
    ],
    'new_with_braces' => [
        'named_class' => true,
        'anonymous_class' => false,
    ],
    'no_closing_tag' => true,
    'no_empty_phpdoc' => true,
    'no_extra_blank_lines' => true,
    'no_superfluous_phpdoc_tags' => [
        'allow_mixed' => true,
    ],
    'no_trailing_whitespace' => true,
    'no_trailing_whitespace_in_comment' => true,
    'no_whitespace_in_blank_line' => true,
    'no_unused_imports' => true,
    'ordered_imports' => [
        'imports_order' => [
            'class',
            'function',
            'const',
        ],
        'sort_algorithm' => 'alpha'
    ],
    'phpdoc_align' => [
        'align' => 'vertical',
        'tags' => [
            'param',
        ]
    ],
    'phpdoc_line_span' => [
        'property' => 'single',
        'method' => null,
        'const' => null
    ],
    'phpdoc_trim' => true,
    'phpdoc_trim_consecutive_blank_line_separation' => true,
    'return_type_declaration' => [
        'space_before' => 'one'
    ],
    'single_blank_line_at_eof' => true,
    'single_import_per_statement' => true,
    'strict_param' => true,
    'unary_operator_spaces' => true,
])
    ->setFinder(PhpCsFixer\Finder::create()->in(__DIR__ . "/src"))
    ->setIndent("\t")
    ->setLineEnding("\n")
    ->setRiskyAllowed(true);