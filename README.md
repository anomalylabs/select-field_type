# Select Field Type

*anomaly.field_type.select*

#### A dropdown field type.

The select field type provides a powerful HTML select input with multiple option handlers and configuration modes.

## Features

- Multiple option handlers (options, countries, currencies, states, timezones, years, months, emails, layouts)
- Three display modes: dropdown, search, tags
- Custom option separators
- Automatic option parsing from various sources
- Support for key-value pairs and simple arrays
- Integration with theme layouts and email templates
- Built-in validation
- Database storage optimization

## Configuration

### Basic Configuration

```php
protected $fields = [
    'status' => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'options' => [
                'draft'     => 'Draft',
                'published' => 'Published',
                'archived'  => 'Archived'
            ]
        ]
    ]
];
```

### Available Handlers

```php
// Countries handler
'country' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'handler' => 'countries'
    ]
]

// Currencies handler
'currency' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'handler' => 'currencies'
    ]
]

// States handler (US states)
'state' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'handler' => 'states'
    ]
]

// Timezones handler
'timezone' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'handler' => 'timezones'
    ]
]

// Years handler
'year' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'handler' => 'years',
        'min'     => 2000,
        'max'     => 2030
    ]
]

// Months handler
'month' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'handler' => 'months'
    ]
]

// Theme layouts handler
'layout' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'handler' => 'layouts'
    ]
]

// Email templates handler
'template' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'handler' => 'emails'
    ]
]
```

### Display Modes

```php
// Dropdown mode (default)
'field' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'mode' => 'dropdown'
    ]
]

// Search mode (with autocomplete)
'field' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'mode' => 'search'
    ]
]

// Tags mode (for visual distinction)
'field' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'mode' => 'tags'
    ]
]
```

### Option Separators

```php
// Using colon separator (default)
'type' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'options' => [
            'key:Value Label',
            'another:Another Label'
        ],
        'separator' => ':'
    ]
]

// Using equal sign separator
'type' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'options' => [
            'key=Value Label',
            'another=Another Label'
        ],
        'separator' => '='
    ]
]
```

## Usage Examples

### Basic Select

```php
$stream->create([
    'status' => 'published'
]);
```

### With Search Mode

```php
protected $fields = [
    'country' => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'handler' => 'countries',
            'mode'    => 'search'
        ]
    ]
];
```

### Dynamic Options from Database

```php
'category' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'options' => function() {
            return CategoryModel::all()->pluck('name', 'id')->toArray();
        }
    ]
]
```

## Accessing Values

### In Twig Templates

```twig
{{ entry.status }}

{{ entry.status.value }}

{# Get label #}
{{ entry.status.label }}

{# Check value #}
{% if entry.status.value == 'published' %}
    <span class="badge badge-success">Published</span>
{% endif %}
```

### In PHP

```php
$entry = $model->find(1);

// Get value
$value = $entry->status;

// Get label
$label = $entry->getFieldTypeLabel('status');

// Get all options
$options = $entry->getFieldType('status')->getOptions();
```

## Setting Values

### In Forms

```php
$form = $builder->make('example.module.test');
$form->on('saving', function(FormBuilder $builder) {
    $entry = $builder->getFormEntry();
    $entry->status = 'published';
});
```

### Direct Assignment

```php
$entry->status = 'draft';
$entry->save();
```

## Database Structure

The select field type stores the selected value as:
- **VARCHAR(255)** - The selected option key

## Validation

### Required Field

```php
'status' => [
    'type'  => 'anomaly.field_type.select',
    'rules' => [
        'required'
    ]
]
```

### In Array Validation

```php
'status' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'options' => [
            'draft'     => 'Draft',
            'published' => 'Published'
        ]
    ],
    'rules' => [
        'in:draft,published'
    ]
]
```

## Common Use Cases

### Status Selection

```php
'status' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'options' => [
            'active'   => 'Active',
            'inactive' => 'Inactive',
            'pending'  => 'Pending'
        ]
    ]
]
```

### Country Selector with Search

```php
'country' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'handler' => 'countries',
        'mode'    => 'search'
    ]
]
```

### Theme Layout Selection

```php
'layout' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'handler' => 'layouts'
    ]
]
```

### Year Range Selection

```php
'birth_year' => [
    'type'   => 'anomaly.field_type.select',
    'config' => [
        'handler' => 'years',
        'min'     => 1920,
        'max'     => 2024
    ]
]
```

## Best Practices

1. **Use Handlers**: Leverage built-in handlers for common data types (countries, timezones, etc.)
2. **Choose Appropriate Mode**: Use `search` mode for large option lists (>20 items)
3. **Consistent Keys**: Use consistent, predictable keys (slug format)
4. **Validation**: Always validate against allowed options
5. **Performance**: For dynamic options, consider caching
6. **Accessibility**: Provide clear, descriptive labels
7. **Database Optimization**: Use indexed columns for frequently queried select fields

## Requirements

- Streams Platform ^1.10
- PyroCMS 3.10+

## License

The Select Field Type is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Authors

PyroCMS, Inc. - [https://pyrocms.com](https://pyrocms.com)
Ryan Thompson - [support@pyrocms.com](mailto:support@pyrocms.com)
