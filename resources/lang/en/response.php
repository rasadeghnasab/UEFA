<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Response messages Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match
    | response messages to api calls.
    |
    */
    'successfulSent' => 'Successfully sent.',

    'unsuccessfulSent' => 'Unsuccessful sent.',

    'methodNotAvailable' => 'This method is not available now',

    'internalServerError' => 'Internal Server Error please try again',

    'TheGivenDataWasInvalid' => 'The given data was invalid.',

    'belongs' => ':child does not belongs to :parent',

    'owns' => [
        'failed' => ':owns does not belongs to :owner',
        'success' => ':owns does belongs to :owner',
    ],

    'crud' => [
        'success' => [
            'store' => ':model created successfully',
            'update' => ':model updated successfully',
            'delete' => ':model removed successfully',
            'restore' => ':model restored successfully',
            'archive' => ':model archived successfully',
            'retrieve' => ':model retrieved successfully',
            'verify' => ':model verified successfully',
            'confirm' => ':model confirmed successfully.'
        ],
        'fail' => [
            'store' => 'Failed to create :model',
            'update' => 'Failed to update :model',
            'delete' => 'Failed to delete :model',
            'restore' => 'Failed to restore :model',
            'archive' => 'Failed to archive :model',
            'retrieve' => 'Failed to retrieve :model',
            'verify' => 'Failed to verify the :model',
            'confirm' => 'Failed to confirm the :model',
        ],
    ],

    'social' => [
        'networks' => [
            'addOrUpdate' => [
                'successful' => 'Social network updated successfully.',
                'fail' => 'Social network update fails. Please try again.'
            ],
            'destroy' => [
                'successful' => 'Social network removed successfully.',
                'fail' => 'Failed to remove social network. Please try again.'
            ],
        ]
    ],
];
