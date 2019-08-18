<?php

namespace Test\Functional\Krizalys\Onedrive;

use Krizalys\Onedrive\Proxy\AudioProxy;
use Krizalys\Onedrive\Proxy\BaseItemProxy;
use Krizalys\Onedrive\Proxy\DeletedProxy;
use Krizalys\Onedrive\Proxy\DriveItemProxy;
use Krizalys\Onedrive\Proxy\DriveProxy;
use Krizalys\Onedrive\Proxy\EntityProxy;
use Krizalys\Onedrive\Proxy\FileProxy;
use Krizalys\Onedrive\Proxy\FileSystemInfoProxy;
use Krizalys\Onedrive\Proxy\FolderProxy;
use Krizalys\Onedrive\Proxy\GeoCoordinatesProxy;
use Krizalys\Onedrive\Proxy\GraphListProxy;
use Krizalys\Onedrive\Proxy\IdentitySetProxy;
use Krizalys\Onedrive\Proxy\ImageProxy;
use Krizalys\Onedrive\Proxy\ItemReferenceProxy;
use Krizalys\Onedrive\Proxy\ListItemProxy;
use Krizalys\Onedrive\Proxy\PackageProxy;
use Krizalys\Onedrive\Proxy\PermissionProxy;
use Krizalys\Onedrive\Proxy\PhotoProxy;
use Krizalys\Onedrive\Proxy\PublicationFacetProxy;
use Krizalys\Onedrive\Proxy\QuotaProxy;
use Krizalys\Onedrive\Proxy\RemoteItemProxy;
use Krizalys\Onedrive\Proxy\RootProxy;
use Krizalys\Onedrive\Proxy\SearchResultProxy;
use Krizalys\Onedrive\Proxy\SharedProxy;
use Krizalys\Onedrive\Proxy\SharepointIdsProxy;
use Krizalys\Onedrive\Proxy\SpecialFolderProxy;
use Krizalys\Onedrive\Proxy\SystemProxy;
use Krizalys\Onedrive\Proxy\ThumbnailProxy;
use Krizalys\Onedrive\Proxy\UploadSessionProxy;
use Krizalys\Onedrive\Proxy\UserProxy;
use Krizalys\Onedrive\Proxy\VideoProxy;
use Krizalys\Onedrive\Proxy\WorkbookProxy;

trait AssertionsTrait
{
    private function assertBaseItemProxy($baseItem)
    {
        $this->assertEntityProxy($baseItem);
        $this->assertInstanceOf(BaseItemProxy::class, $baseItem);

        $this->assertThat(
            $baseItem->createdBy,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(IdentitySetProxy::class, $baseItem->createdBy)
            )
        );

        $this->assertThat(
            $baseItem->createdDateTime,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(\DateTime::class)
            )
        );

        $this->assertThat(
            $baseItem->description,
            $this->logicalOr(
                $this->isNull(),
                $this->isType('string')
            )
        );

        $this->assertThat(
            $baseItem->eTag,
            $this->logicalOr(
                $this->isNull(),
                $this->isType('string')
            )
        );

        $this->assertThat(
            $baseItem->lastModifiedBy,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(IdentitySetProxy::class, $baseItem->createdBy)
            )
        );

        $this->assertThat(
            $baseItem->lastModifiedDateTime,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(\DateTime::class)
            )
        );

        $this->assertThat(
            $baseName->name,
            $this->logicalOr(
                $this->isNull(),
                $this->isType('string')
            )
        );

        $this->assertThat(
            $baseItem->parentReference,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(ItemReferenceProxy::class, $baseItem->parentReference)
            )
        );

        $this->assertThat(
            $baseItem->webUrl,
            $this->logicalOr(
                $this->isNull(),
                $this->matchesRegularExpression(self::URI_REGEX)
            )
        );

        $this->assertThat(
            $baseItem->createdByUser,
            $this->logicalOr(
                $this->isNull,
                $this->isInstanceOf(UserProxy::class)
            )
        );

        $this->assertThat(
            $baseItem->lastModifiedByUser,
            $this->logicalOr(
                $this->isNull,
                $this->isInstanceOf(UserProxy::class)
            )
        );
    }

    private function assertDriveItemProxy($item)
    {
        $this->assertBaseItemProxy($item);
        $this->assertInstanceOf(DriveItemProxy::class, $item);

        $this->assertThat(
            $item->audio,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(AudioProxy::class)
            )
        );

        //"content" => [ "@odata.type" => "Edm.Stream" ],
        $this->assertNotNull($item->cTag);

        $this->assertThat(
            $item->deleted,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(DeletedProxy::class)
            )
        );

        $this->assertThat(
            $item->file,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(FileProxy::class)
            )
        );

        $this->assertThat(
            $item->fileSystemInfo,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(FileSystemInfoProxy::class)
            )
        );

        $this->assertThat(
            $item->folder,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(FolderProxy::class)
            )
        );

        $this->assertThat(
            $item->image,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(ImageProxy::class)
            )
        );

        $this->assertThat(
            $item->location,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(GeoCoordinatesProxy::class)
            )
        );

        $this->assertThat(
            $item->package,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(PackageProxy::class)
            )
        );

        $this->assertThat(
            $item->photo,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(PhotoProxy::class)
            )
        );

        $this->assertThat(
            $item->publication,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(PublicationFacetProxy::class)
            )
        );

        $this->assertThat(
            $item->remoteItem,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(RemoteItemProxy::class)
            )
        );

        $this->assertThat(
            $item->root,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(RootProxy::class)
            )
        );

        $this->assertThat(
            $item->searchResult,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(SearchResultProxy::class)
            )
        );

        $this->assertThat(
            $item->shared,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(SharedProxy::class)
            )
        );

        $this->assertThat(
            $item->sharepointIds,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(SharepointIdsProxy::class)
            )
        );

        $this->assertThat(
            $item->size,
            $this->logicalOr(
                $this->isNull(),
                $this->greaterThanOrEqual(0)
            )
        );

        $this->assertThat(
            $item->specialFolder,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(SpecialFolderProxy::class)
            )
        );

        $this->assertThat(
            $item->video,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(VideoProxy::class)
            )
        );

        $this->assertThat(
            $item->webDavUrl,
            $this->logicalOr(
                $this->isNull(),
                $this->matchesRegularExpression(self::URI_REGEX)
            )
        );

        foreach ($item->children as $child) {
            $this->assertDriveItemProxy($child);
        }

        $this->assertThat(
            $item->listItem,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(ListItemProxy::class)
            )
        );

        if ($item->permissions !== null) {
            foreach ($item->permissions as $permission) {
                $this->assertPermissionProxy($permission);
            }
        }

        if ($item->thumbnails !== null) {
            foreach ($item->thumbnails as $thumbnail) {
                $this->assertThumbnailProxy($thumbnail);
            }
        }

        if ($item->versions !== null) {
            foreach ($item->versions as $version) {
                $this->assertInternalType('string', $version);
            }
        }

        $this->assertThat(
            $item->workbook,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(WorkbookProxy::class)
            )
        );
    }

    private function assertDriveProxy($drive)
    {
        $this->assertBaseItemProxy($drive);
        $this->assertInstanceOf(DriveProxy::class, $drive);
        $this->assertContains($drive->driveType, ['personal', 'business', 'documentLibrary']);
        $this->assertInstanceOf(IdentitySetProxy::class, $drive->owner);
        $this->assertQuotaProxy($drive->quota);

        $this->assertThat(
            $drive->sharePointIds,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(SharepointIdsProxy::class)
            )
        );

        $this->assertThat(
            $drive->system,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(SystemProxy::class)
            )
        );

        if ($drive->items !== null) {
            foreach ($drive->items as $item) {
                $this->assertDriveItemProxy($item);
            }
        }

        $this->assertThat(
            $drive->list,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(GraphListProxy::class)
            )
        );

        $this->assertThat(
            $drive->root,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(DriveItemProxy::class)
            )
        );

        $this->assertThat(
            $drive->special,
            $this->logicalOr(
                $this->isNull(),
                $this->isInstanceOf(DriveItemProxy::class)
            )
        );
    }

    private function assertEntityProxy($entity)
    {
        $this->assertInstanceOf(EntityProxy::class, $entity);
        $this->assertInternalType('string', $entity->id);
    }

    private function assertPermissionProxy($permission)
    {
        $this->assertInstanceOf(PermissionProxy::class, $permission);
    }

    private function assertQuotaProxy($quota)
    {
        $this->assertInstanceOf(QuotaProxy::class, $quota);
        $this->assertGreaterThanOrEqual(0, $quota->deleted);
        $this->assertGreaterThanOrEqual(0, $quota->remaining);
        $this->assertContains($quota->state, ['normal', 'nearing', 'critical', 'exceeded']);
        $this->assertGreaterThanOrEqual(0, $quota->total);
        $this->assertGreaterThanOrEqual(0, $quota->used);
    }

    private function assertRootProxy($root)
    {
        $this->assertInstanceOf(RootProxy::class, $root);
    }

    private function assertSpecialFolderProxy($specialFolder)
    {
        $this->assertInstanceOf(SpecialFolderProxy::class, $specialFolder);
        $this->assertInternalType('string', $specialFolder->name);
    }

    private function assertThumbnailProxy($thumbnail)
    {
        $this->assertInstanceOf(ThumbnailProxy::class, $thumbnail);
    }

    private function assertUploadSessionProxy($uploadSession)
    {
        $this->assertInstanceOf(UploadSessionProxy::class, $uploadSession);
        $this->assertInstanceOf(\DateTime::class, $uploadSession->expirationDateTime);
        $this->assertCount(1, $uploadSession->nextExpectedRanges);
        $this->assertEquals('0-', $uploadSession->nextExpectedRanges[0]);
        $this->assertRegExp(self::URI_REGEX, $uploadSession->uploadUrl);
    }
}