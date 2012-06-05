-- add the new unique key to the participant table and remove the eligible column
-- we need to create a procedure which only alters the participant table if the
-- unique key is missing or the eligible column exists
DROP PROCEDURE IF EXISTS patch_participant;
DELIMITER //
CREATE PROCEDURE patch_participant()
  BEGIN
    DECLARE test INT;
    SET @test = (
      SELECT COUNT(*)
      FROM information_schema.TABLE_CONSTRAINTS
      WHERE TABLE_SCHEMA = ( SELECT DATABASE() )
      AND TABLE_NAME = "participant"
      AND CONSTRAINT_NAME = "uq_person_id" );
    IF @test = 0 THEN
      ALTER TABLE participant
      ADD UNIQUE INDEX uq_person_id  ( person_id ASC );
    END IF;

    SET @test = (
      SELECT COUNT(*)
      FROM information_schema.COLUMNS
      WHERE TABLE_SCHEMA = ( SELECT DATABASE() )
      AND TABLE_NAME = "participant"
      AND COLUMN_NAME = "eligible" );
    IF @test = 1 THEN
      ALTER TABLE participant DROP COLUMN eligible;
    END IF;
  END //
DELIMITER ;

-- now call the procedure and remove the procedure
CALL patch_participant();
DROP PROCEDURE IF EXISTS patch_participant;