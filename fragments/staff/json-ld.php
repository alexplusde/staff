<?php
/**
 * @var rex_fragment $this
 * @var rex_staff $person
 */
$person = staff::get($this->getVar('id'));

$jsonLd = [
    "@context" => "https://schema.org",
    "@type" => "Person",
    "address" => [
        "@type" => "PostalAddress",
        "addressLocality" => $person->getCity(),
        "addressRegion" => $person->getRegion(),
        "postalCode" => $person->Zip(),
        "streetAddress" => $person->getStreet()
    ],
    "email" => "mailto:" . $person->getEmail(),
    "image" => $person->getMediaUrl(),
//  "jobTitle" => $person->getJobTitle(),
    "name" => $person->getName() ?? $person->getFullname(),
    "telephone" => $person->getPhone(),
//  "url" => $person->getUrl()
];

echo '<script type="application/ld+json">' . json_encode($jsonLd, JSON_UNESCAPED_SLASHES) . '</script>';
