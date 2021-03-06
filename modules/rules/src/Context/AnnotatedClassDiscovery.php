<?php

/**
 * @file
 * Contains \Drupal\rules\Plugin\Context\AnnotatedClassDiscovery.
 */

namespace Drupal\rules\Context;

use Doctrine\Common\Annotations\SimpleAnnotationReader;
use \Drupal\Core\Plugin\Discovery\AnnotatedClassDiscovery as CoreAnnotatedClassDiscovery;

/**
 * Extends the annotation class discovery for usage with Rules context.
 */
class AnnotatedClassDiscovery extends CoreAnnotatedClassDiscovery {

  /**
   * {@inheritdoc}
   */
  protected function getAnnotationReader() {
    if (!isset($this->annotationReader)) {
      // Do not call out the parent, but re-configure the simple annotation
      // reader on our own, so we can control the order of namespaces.
      $this->annotationReader = new SimpleAnnotationReader();

      // Make sure to add our namespace first, so our ContextDefinition class
      // gets picked.
      $this->annotationReader->addNamespace('Drupal\rules\Context\Annotation');
      // Add the namespaces from the main plugin annotation, like @EntityType.
      $namespace = substr($this->pluginDefinitionAnnotationName, 0, strrpos($this->pluginDefinitionAnnotationName, '\\'));
      $this->annotationReader->addNamespace($namespace);
      // Add general core annotations like @Translation.
      $this->annotationReader->addNamespace('Drupal\Core\Annotation');
    }
    return $this->annotationReader;
  }

}
