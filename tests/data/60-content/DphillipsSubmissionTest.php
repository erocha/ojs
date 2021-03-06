<?php

/**
 * @file tests/data/60-content/DphillipsSubmissionTest.php
 *
 * Copyright (c) 2014 Simon Fraser University Library
 * Copyright (c) 2000-2014 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class DphillipsSubmissionTest
 * @ingroup tests_data
 *
 * @brief Data build suite: Create submission
 */

import('tests.data.ContentBaseTestCase');

class DphillipsSubmissionTest extends ContentBaseTestCase {
	/**
	 * Create a submission.
	 */
	function testSubmission() {
		$this->register(array(
			'username' => 'dphillips',
			'firstName' => 'Dana',
			'lastName' => 'Phillips',
			'affiliation' => 'University of Toronto',
			'country' => 'Canada',
			'roles' => array('Author'),
		));

		$title = 'Investigating the Shared Background Required for Argument: A Critique of Fogelin’s Thesis on Deep Disagreement';
		$this->createSubmission(array(
			'title' => $title,
			'abstract' => 'Robert Fogelin claims that interlocutors must share a framework of background beliefs and commitments in order to fruitfully pursue argument. I refute Fogelin’s claim by investigating more thoroughly the shared background required for productive argument. I find that this background consists not in any common beliefs regarding the topic at hand, but rather in certain shared pro-cedural commitments and competencies. I suggest that Fogelin and his supporters mistakenly view shared beliefs as part of the required background for productive argument because these procedural com-mitments become more difficult to uphold when people’s beliefs diverge widely regarding the topic at hand.',
		));

		$this->logOut();
		$this->findSubmissionAsEditor('dbarnes', null, $title);
		$this->assignParticipant('Section editor', 'Stephanie Berardo');
		$this->sendToReview();
		$this->assignReviewer('jjanssen', 'Julie Janssen');
		$this->assignReviewer('agallego', 'Adela Gallego');
		$this->recordEditorialDecision('Accept Submission');
		$this->waitForText('css=a.editorial.stageId4 > div.stageState', 'Initiated');
		$this->assignParticipant('Copyeditor', 'Maria Fritz');
		$this->recordEditorialDecision('Send To Production');
		$this->waitForText('css=a.production.stageId5 > div.stageState', 'Initiated');
		$this->assignParticipant('Layout Editor', 'Graham Cox');
		$this->logOut();
	}
}
