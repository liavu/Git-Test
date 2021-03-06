<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Integration\Condition\ConditionManagerTest.
 */

namespace Drupal\Tests\rules\Integration\Condition;

use Drupal\Tests\rules\Integration\RulesIntegrationTestBase;

/**
 * Tests the Rules condition manager.
 */
class ConditionManagerTest extends RulesIntegrationTestBase {

  /**
   * @cover getDiscovery()
   */
  public function testContextDefinitionAnnotations() {
    $definitions = $this->conditionManager->getDefinitions();
    // Make sure all context definitions are using the class provided by Rules.
    foreach ($definitions as $definition) {
      if (!empty($definition['context'])) {
        foreach ($definition['context'] as $context_definition) {
          $this->assertInstanceOf('Drupal\rules\Context\ContextDefinitionInterface', $context_definition);
        }
      }
    }
  }
}
