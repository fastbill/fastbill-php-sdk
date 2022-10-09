<?php
use PhpCsFixer\Config;

$blacklistedFiles = [
    'credentials.php',
];
$finder = PhpCsFixer\Finder::create()
        ->in(__DIR__ . '/examples')
        ->in(__DIR__ . '/src')
        ->in(__DIR__ . '/tests')
        ->filter(function(SplFileInfo $file) use ($blacklistedFiles) {
            return !in_array($file->getFilename(), $blacklistedFiles, true);
        })
    ;


return (new Config())
    ->setRules([
        '@PSR12' => true,
        '@Symfony' => true,

        // Fix declare style
        'blank_line_after_opening_tag' => false,

        // override @Symonfy
        'phpdoc_align' => false,
        'phpdoc_separation' => false,
        'yoda_style' => false,
        'phpdoc_summary' => false,
        'increment_style' => false,
        'php_unit_fqcn_annotation' => false,

        'array_syntax' => [
            'syntax' => 'short'
        ],
        'class_definition' => [
            'single_line' => true
        ],
        'comment_to_phpdoc' => true,
        'concat_space' => [
            'spacing' => 'one'
        ],
        'declare_strict_types' => true,
        'dir_constant' => true,
        'is_null' => true,
        'no_null_property_initialization' => true,
        'no_superfluous_phpdoc_tags' => true,
        'no_useless_return' => true,
        'no_useless_else' => true,
        'multiline_whitespace_before_semicolons' => true,
        'mb_str_functions' => true,
        'ordered_class_elements' => false,
        'ordered_imports' => true,
        'phpdoc_order_by_value' => true,
        'php_unit_namespaced' => true,
        'php_unit_construct' => true,
        'phpdoc_add_missing_param_annotation' => [
            'only_untyped' => true
        ],
        'phpdoc_order' => true,
        'phpdoc_var_annotation_correct_order' => true,
        'strict_comparison' => true,
        'strict_param' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);