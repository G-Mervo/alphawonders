<?php
/**
 * Joomla! Content Management System
 *
 * @copyright  Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\CMS\Helper;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Table\TableInterface;
use Joomla\Utilities\ArrayHelper;

/**
 * Tags helper class, provides methods to perform various tasks relevant
 * tagging of content.
 *
 * @since  3.1
 */
class TagsHelper extends CMSHelper
{
	/**
	 * Helper object for storing and deleting tag information.
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $tagsChanged = false;

	/**
	 * Whether up replace all tags or just add tags
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $replaceTags = false;

	/**
	 * Alias for querying mapping and content type table.
	 *
	 * @var    string
	 * @since  3.1
	 */
	public $typeAlias = null;

	/**
	 * Method to add tag rows to mapping table.
	 *
	 * @param   integer         $ucmId  ID of the #__ucm_content item being tagged
	 * @param   TableInterface  $table  Table object being tagged
	 * @param   array           $tags   Array of tags to be applied.
	 *
	 * @return  boolean  true on success, otherwise false.
	 *
	 * @since   3.1
	 */
	public function addTagMapping($ucmId, TableInterface $table, $tags = array())
	{
		$db = $table->getDbo();
		$key = $table->getKeyName();
		$item = $table->$key;
		$typeId = $this->getTypeId($this->typeAlias);

		// Insert the new tag maps
		if (strpos('#', implode(',', $tags)) === false)
		{
			$tags = self::createTagsFromField($tags);
		}

		// Prevent saving duplicate tags
		$tags = array_unique($tags);

		$query = $db->getQuery(true);
		$query->insert('#__contentitem_tag_map');
		$query->columns(
			array(
				$db->quoteName('type_alias'),
				$db->quoteName('core_content_id'),
				$db->quoteName('content_item_id'),
				$db->quoteName('tag_id'),
				$db->quoteName('tag_date'),
				$db->quoteName('type_id'),
			)
		);

		foreach ($tags as $tag)
		{
			$query->values(
				$db->quote($this->typeAlias)
				. ', ' . (int) $ucmId
				. ', ' . (int) $item
				. ', ' . $db->quote($tag)
				. ', ' . $query->currentTimestamp()
				. ', ' . (int) $typeId
			);
		}

		$db->setQuery($query);

		return (boolean) $db->execute();
	}

	/**
	 * Function that converts tags paths into paths of names
	 *
	 * @param   array  $ta