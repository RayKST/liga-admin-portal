<?php

function validateCard(array $input): array
{
    $nameEn = trim($input['name_en'] ?? '');
    $namePt = trim($input['name_pt'] ?? '');
    $cardGame = trim($input['card_game'] ?? '');
    $editionId = $input['edition_id'] ?? '';
    $image = trim($input['image'] ?? '');
    $rarity = trim($input['rarity'] ?? '');

    if ($nameEn === '') {
        return ['error' => 'English name is required'];
    }

    if (!in_array(
        $cardGame,
        ['magic', 'pokemon', 'yugioh'],
        true
    )) {
        return ['error' => 'Invalid card game'];
    }

    if ($editionId === '') {
        return ['error' => 'Edition is required'];
    }

    if ($rarity === '') {
        return ['error' => 'Rarity is required'];
    }

    return [
        'data' => [
            'name_en' => $nameEn,
            'name_pt' => $namePt !== '' ? $namePt : null,
            'card_game' => $cardGame,
            'edition_id' => $editionId,
            'image' => $image !== '' ? $image : null,
            'rarity' => $rarity
        ]
    ];
}

function validateEdition(string $cardGame, string $editionId): ?string
{
    $editionsPath = __DIR__ . '/../../../utils/editions.json';

    $editions = json_decode(
        file_get_contents($editionsPath),
        true
    );

    foreach ($editions[$cardGame] ?? [] as $edition) {
        if ($edition['id'] === $editionId) {
            return $edition['name'];
        }
    }

    return null;
}