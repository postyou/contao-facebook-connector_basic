<?php
namespace postyou;

abstract class ConnectionType
{

    const POST_GET = 'PostGet';

    const POST_PUBLISH = 'PostPublish';

    const GALLERY_GET = 'GalleryGet';

    const GALLERY_PUBLISH = 'GalleryPublish';

    const EVENTS = 'Events';
}